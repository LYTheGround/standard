<div class="panel activity-panel">
    <div class="panel-heading">
        <h6 class="panel-title">{{ __('validation.attributes.progress') }}</h6>
        <div class="progress progress-xs progress-striped">
            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="{{ $buy->progress }}%"
                 style="width: {{ $buy->progress }}%"></div>
        </div>
    </div>
    <div class="panel-body">
        <div class="activity-box">
            <ul class="activity-list">
                @if($buy->purchased)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->purchased]) }}"
                                   class="name">{{ $buy->purchased->info->full_name }}</a> à confirmé le <a href="#">Bon
                                    de
                                    commande</a>
                                <span class="time">{{ $buy->purchased_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($buy->quoted)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->quoter]) }}"
                                   class="name">{{ $buy->quoter->info->full_name }}</a> à confirmé le <a
                                        href="#">Devi</a>
                                <span class="time">{{ $buy->quote_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($buy->delivery)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->delivered]) }}"
                                   class="name">{{ $buy->delivered->info->full_name }}</a> à marquez la <a
                                        href="#">livraison</a>
                                <span class="time">{{ $buy->delivered_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($buy->store)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->stored]) }}"
                                   class="name">{{ $buy->stored->info->full_name }}</a> à indiquez dans le <a
                                        href="#">Stock</a>
                                <span class="time">{{ $buy->stored_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($buy->formed)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->former]) }}"
                                   class="name">{{ $buy->former->info->full_name }}</a> à uploader le <a
                                        href="#">Bon de commande</a>
                                <span class="time">{{ $buy->formed_at }}</span>
                            </div>
                        </div>
                    </li>
                @endif
                @if($buy->invoiced)
                    <li>
                        <div class="activity-user">
                            <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                     class="img-responsive img-circle">
                            </a>
                        </div>
                        <div class="activity-content">
                            <div class="timeline-content">
                                <a href="{{ route('member.show',['member' => $buy->invoicer]) }}"
                                   class="name">{{ $buy->invoicer->info->full_name }}</a> à uploader la <a
                                        href="#">Facture</a>
                                <span class="time">{{ $buy->invoiced_at }}</span>
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
                @if($buy->name_prev)
                    {{ Form::open(['method' => 'DELETE', 'url' => $buy->route_prev]) }}
                    <button type="submit" class="text-primary btn btn-danger">{{ $buy->name_prev }}</button>
                    {{ Form::close() }}
                @endif
            </div>
            <div class="col-xs-6 text-right">
                @if($buy->name_next)
                    {{ Form::open(['url' => $buy->route_next]) }}
                    <button type="submit" class="text-primary btn btn-success">{{ $buy->name_next }}</button>
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>