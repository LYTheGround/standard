<div class="panel activity-panel">
    <div class="panel-heading">
        <h6 class="panel-title">{{ __('validation.attributes.progress') }}</h6>
        <div class="progress progress-xs progress-striped">
            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="{{ $sale->progress }}%"
                 style="width: {{ $sale->progress }}%"></div>
        </div>
    </div>
    <div class="panel-body">
        <div class="activity-box">
            <ul class="activity-list">
                @if($sale->purchased)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->purchased]) }}"
                                   class="name">{{ $sale->purchased->info->full_name }}</a> à confirmé le <a href="#">Bon
                                    de
                                    commande</a>
                                <span class="time">{{ $sale->purchased_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($sale->quoted)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->quoter]) }}"
                                   class="name">{{ $sale->quoter->info->full_name }}</a> à confirmé le <a
                                        href="#">Devi</a>
                                <span class="time">{{ $sale->quote_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($sale->delivery)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->delivered]) }}"
                                   class="name">{{ $sale->delivered->info->full_name }}</a> à marquez la <a
                                        href="#">livraison</a>
                                <span class="time">{{ $sale->delivered_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($sale->store)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->stored]) }}"
                                   class="name">{{ $sale->stored->info->full_name }}</a> à indiquez dans le <a
                                        href="#">Stock</a>
                                <span class="time">{{ $sale->stored_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($sale->formed)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->former]) }}"
                                   class="name">{{ $sale->former->info->full_name }}</a> à uploader le <a
                                        href="#">Bon de commande</a>
                                <span class="time">{{ $sale->formed_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($sale->invoiced)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $sale->invoicer]) }}"
                                   class="name">{{ $sale->invoicer->info->full_name }}</a> à uploader la <a
                                        href="#">Facture</a>
                                <span class="time">{{ $sale->invoiced_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="panel-footer text-right">
        <div class="row">
            <div class="col-xs-6 text-left">
                @if($sale->name_prev)
                    {{ Form::open(['method' => 'DELETE', 'url' => $sale->route_prev]) }}
                    <button type="submit" class="text-primary btn btn-danger">{{ $sale->name_prev }}</button>
                    {{ Form::close() }}
                @endif
            </div>
            <div class="col-xs-6 text-right">
                @if($sale->name_next)
                    {{ Form::open(['url' => $sale->route_next]) }}
                    <button type="submit" class="text-primary btn btn-success">{{ $sale->name_next }}</button>
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>