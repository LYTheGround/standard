<?php

namespace App\Http\Controllers\Rh;

use App\Http\Requests\Company\StatusRequest;
use App\Http\Requests\Rh\InfoRequest;
use App\Http\Requests\Rh\PswRequest;
use App\Http\Requests\Rh\RangeRequest;
use App\Member;
use App\Http\Controllers\Controller;
use App\Notifications\Rh\UpdateUserNotification;
use App\Premium;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        return view('member.index',['members' => auth()->user()->member->colleagues()]);
    }

    public function show(Member $member)
    {
        return view('member.show',compact('member'));
    }

    public function params()
    {
        return view('member.params',['member' => auth()->user()->member]);
    }

    public function updateParams(InfoRequest $request)
    {

        $r = $request->all();
        $r['city_id'] = $request->city;

        $member = auth()->user()->member;

        $info = $member->info;

        if(!is_null($request->file('face'))){
            if($info->face){
                Storage::disk('public')->delete($info->face);
            }
            $face = $request->file('face')->store('users');
            $r['face'] = $face;
        }

        $info->update($r);

        $member->update($r);

        $member->info->emails[0]->update(['email' => $request->email]);

        $member->info->tels[0]->update(['tel' => $request->phone]);

        session()->flash('status', __('rh/member.success_params'));

        Notification::send(auth()->user()->colleagues(),new UpdateUserNotification(auth()->user()));

        return redirect()->route('member.show',compact('member'));
    }

    public function psw()
    {
        return view('member.psw');
    }

    public function updatePsw(PswRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->password)]);

        session()->flash('status', __('rh/member.psw_success'));

        return redirect()->route('member.show',['member' => auth()->user()->member]);
    }

    public function range(Member $member)
    {
        if($member->premium->status->status == 'active'){
            return view('member.range',compact('member'));
        }
        else{
            if($member->premium->status->status == 'inactive'){
                session()->flash('danger',trans('rh/member.danger_inactive'));
            }
            else{
                session()->flash('danger',trans('rh/member.danger_archived'));
            }
            return back();
        }
    }

    public function updateRange(RangeRequest $request,Member $member)
    {
        $premium = $member->premium;
        $premium_company = $member->company->premium;
        $range = $premium->range + $request->range;
        if($premium->category->category != 'pdg'){
            if($premium->status->status == 'inactive'){
                $this->addRange($range,$premium);
                $this->sold($request->range,$premium_company);
            }
            elseif($premium->status->status == 'active'){
                $date = $this->addDate($range,$premium->limit);
                $this->updateDate($date,$premium);
                $this->sold($range,$premium_company);
            }
            else{
                session()->flash('danger',__("rh/member.danger_archived"));
                return back();
            }
        }
        else{
            $date = $this->addDate($range,$premium->limit);
            $this->updateDate($date,$premium);
            $this->updateDate($date,$premium_company);
            $this->sold($range,$premium_company);
        }
        session()->flash('status',trans('rh/member.range_success'));
        return redirect()->route('member.show',compact('member'));
    }

    private function addDate($range, $date)
    {
        $date = new DateTime($date);
        $date->add(new DateInterval('P'. $range .'D'));
        return  $date->format('Y-m-d');
    }

    private function addRange($range, $premium)
    {
        return $premium->update(['range' => $range]);
    }

    private function sold($range, $premium)
    {
        return $premium->update(['sold' => $premium->sold - $range]);
    }

    private function updateDate($date,$premium)
    {
        $premium->update(['limit' => $date]);
    }

    public function status(Member $member)
    {
        if($member->premium->category->category == 'pdg'){
            session()->flash('danger', trans('rh/member.danger_status_pdg'));
            return redirect()->route('member.show',compact('member'));
        }
        if($this->canUpdateStatus($member->premium)){
            return view('member.status',compact('member'));
        }
        session()->flash('danger', trans('rh/member.status_bloque',['value' => Carbon::parse($member->premium->update_status)->format('d-m-Y')]));
        return redirect()->route('member.show',compact('member'));

    }

    private function canUpdateStatus($premium)
    {
        return strtotime(date('Y-m-d')) >= strtotime($premium->update_status);
    }

    public function updateStatus(StatusRequest $request, Member $member,Premium $premium)
    {
        if($this->canUpdateStatus($member->premium)){
            $premium->updateStatusMember($request->status,$member->company,$member->premium);
        }
        return redirect()->route('member.show',compact('member'));
    }


    public function destroy(Member $member)
    {
        $this->authorize('delete',$member);

        $member->onDelete();

        return redirect()->route('member.index');
    }
}
