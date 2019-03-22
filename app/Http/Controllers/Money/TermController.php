<?php

namespace App\Http\Controllers\Money;

use App\Deal_product;
use App\Month;
use App\Order;
use App\Product;
use App\Quote;
use App\Term;
use App\Trade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
    public function liste(Term $term)
    {
        // liste entre les deux date
        if(isset($_GET['star']) && isset($_GET['end']) && !empty($_GET['end']) && !empty($_GET['star'])){
            $star = Carbon::parse($_GET['star'])->format('Y-m-d 00:00:00');
            $end = Carbon::parse($_GET['end'])->format('Y-m-d 23:59:59');
            if($star < $end){
                $terms = $term->where([
                    ['date','>',$star],
                    ['date','<', $end]
                ])
                    ->orderBy('payment','desc')
                    ->get();
            }
            else{
                $terms = $term->liste();
                session()->flash('danger','la date de départ doit être inférieur a la date de fin');
            }

        }else{
            $terms = $term->liste();
            session()->flash('danger','vars obligatoire');
        }
        return view('money.term.index',compact('terms'));
    }

    public function index(Term $term)
    {
        // liste impayé
        $terms = $term->liste();
        //dd($terms[0]);
        return view('money.term.index',compact('terms'));
    }

    public function create(Trade $trade)
    {
       return view('money.term.create',compact('trade'));
    }

    public function store(Request $request,Trade $trade,Term $term,Month $month)
    {
        $quote = $trade->quote;

        $date = $request->date;

        $payment = $quote->ttc;

        if($trade->buy){

            foreach ($quote->orders as $order) {

                $product = $order->purchase->product;

                $this->deal_product($order,$product,$quote,$order->purchase->qt);

                $product->update([
                    'amount' => $product->amount + $order->ttc
                ]);


            }

            $this->addPayement($month,$term,$date,$payment,$quote);

            return redirect()->route('buy.show',compact('trade'));

        }

        else{
            foreach ($quote->orders as $order) {

                $product = $order->sold->purchase->product;
                $qt = $order->sold->qt;
                $this->deal_product($order,$product,$quote,$qt);
                $order = $order->sold->purchase->orders->map(function ($query){
                    if($query->quote()->where('selected',true)->first()){
                        return $query;
                    }
                })[0];


                $product->update([
                    'amount' => $product->amount - $order->ttc
                ]);

            }

            $this->addPayement($month,$term,$date,$payment,$quote);

            return redirect()->route('sale.show',compact('trade'));
        }

    }

    private function addPayement(Month $month, Term $term,$date,$payment,$quote)
    {
        $month = $month->select();

        $term->create([
            'payment'       => $payment,
            'date'          => $date,
            'payed_by_id'   => $quote->deal_id,
            'creator_id'    => auth()->user()->member->id,
            'company_id'    => auth()->user()->member->company_id,
            'quote_id'      => $quote->id,
            'trade_id'      => $quote->trade->id,
            'month_id'      => $month->id
        ]);

        $month->addPayement($quote);
    }

    private function deal_product(Order $order,Product $product,Quote $quote,int $qt)
    {
        $ttc = $order->ttc;
        $min = $order->ttc / $qt;
        $tva = $order->tva_payed;
        $is = $order->is;
        $profit = $order->profit;
        $product_deal = Deal_product::where([
            ['product_id',$product->id],
            ['deal_id',$quote->deal_id]
        ])->first();
        if($product_deal){
            if($min > $product_deal->min_prince){
                $min =  $product_deal->min_prince;
            }
            $product_deal->update([
                'min_prince'    => $min,
                'turnover'      => $ttc + $product_deal->turnover,
                'tva'           => $tva + $product_deal->tva,
                'is'            => $is + $product_deal->is,
                'profit'        => $profit + $product_deal->profit,
                'product_id'    => $product->id,
                'deal_id'       => $quote->deal_id
            ]);
        }
        else{
            Deal_product::create([
                'min_prince'    => $ttc,
                'turnover'      => $ttc,
                'tva'           => $tva,
                'is'            => $is,
                'profit'        => $profit,
                'product_id'    => $product->id,
                'deal_id'       => $quote->deal_id
            ]);
        }
    }

    public function payment(Term $term)
    {
        $term->onStorePayed();
        return redirect()->route('term.show',compact('term'));
    }

    public function deletePayment(Term $term)
    {
        $term->onDeletePayed();
        return redirect()->route('term.show',compact('term'));
    }

    public function show(Term $term)
    {
        // show term
        return view('money.term.show',compact('term'));
    }

    public function destroy(Trade $trade)
    {
        foreach ($trade->terms as $term) {

            $term->onDelete();

        }

        if($trade->buy){

            return redirect()->route('buy.show',compact('trade'));

        }

        return redirect()->route('sale.show',compact('trade'));
    }
}
