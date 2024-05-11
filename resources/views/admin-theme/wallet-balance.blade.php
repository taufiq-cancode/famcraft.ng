    <section class="card card-featured-left card-featured-secondary">
        <div class="card-body">
            <div class="widget-summary" style="margin: 25px 0;">
                <div class="widget-summary-col widget-summary-col-icon">
                    <div class="summary-icon bg-secondary">
                        <i class="fa-solid fa-naira-sign"></i>
                    </div>
                </div>
                <div class="widget-summary-col">
                    <div class="summary">
                        <h4><b>Wallet Balance</b></h4>
                        <div class="info">
                            @if(auth()->user()->wallet)
                                <h5 style="font-size: 34px;">&#8358;{{ number_format(auth()->user()->wallet->balance, 2)}}</h5>
                            @else
                                <h5 style="font-size: 34px;">&#8358;0.00</h5>
                            @endif   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
