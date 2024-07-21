<meta name="csrf-token" content="{{ csrf_token() }}">

    @if (session('success'))
		<script>
			toastr.success('{{ session('success') }}', 'Success');
		</script>
	@endif
	@if (session('error'))
		<script>
			toastr.error('{{ session('error') }}', 'Error');
		</script>
	@endif
    
<style>
    .green-text {
        color: green;
        font-weight: bold
    }
</style>

<section class="card card-featured-left card-featured-secondary mb-3">
    <div class="card-body">
        <div class="widget-summary">
            <div class="widget-summary-col widget-summary-col-icon">
                <div class="summary-icon bg-secondary" style="margin-top: 20px">
                    <i class="fa-solid fa-naira-sign"></i>
                </div>
            </div>
            <div class="widget-summary-col">
                <div class="summary">
                    <h4><b>Wallet Balance</b></h4>
                    <div class="info">
                        <h5 style="font-size: 34px;" class="my-4">&#8358;{{ number_format(auth()->user()->wallet->balance, 2)}}</h5>
                        <a href="#modalSMWithdraw" class="mb-1 mt-1 me-1 modal-sizes btn btn-sm btn-secondary bg-secondary">Withdraw</a>
                        <div id="modalSMWithdraw" class="modal-block modal-block-m mfp-hide">
                            <section class="card">
                            <form action="{{ route('withdrawals.request') }}" class="form-horizontal form-bordered" method="POST">
                                @csrf
                                @method('POST')

                                <header class="card-header">
                                    <h2 class="card-title">Withdraw from Wallet</h2>
                                </header>
                                <div class="card-body">
                                    <div class="modal-wrapper">
                                        <div class="form-group row pb-2">
                                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                                            <div class="col-lg-6">
                                                <input type="number" name="amount" class="form-control" id="amount" required placeholder="Enter top up amount">
                                                <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                                <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-2">
                                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Bank Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="bank_name" class="form-control" required placeholder="Enter your bank name">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-2">
                                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Number</label>
                                            <div class="col-lg-6">
                                                <input type="number" name="account_number" class="form-control" required placeholder="Enter your account number">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-2">
                                            <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Name</label>
                                            <div class="col-lg-6">
                                                <input type="text" name="account_name" class="form-control" required placeholder="Enter your account name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button class="btn btn-primary" type="submit">Proceed</button>
                                            <button class="btn btn-default modal-dismiss">Cancel</button>
                                        </div>
                                    </div>
                                </footer>
                            </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>