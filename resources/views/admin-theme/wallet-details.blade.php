<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .green-text {
        color: green;
        font-weight: bold
    }
</style>

<section class="card card-featured-left card-featured-primary mb-3">
    <div class="card-body">
        <div class="widget-summary">
            <div class="widget-summary-col widget-summary-col-icon">
                <div class="summary-icon bg-primary" style="margin-top: 20px">
                    <i class="icons icon-wallet"></i>
                </div>
            </div>
            <div class="widget-summary-col">
                <div class="summary">
                    <h4><b>Wallet Details</b></h4>
                    <div class="info">
                        <h5><b>Account Name:</b> {{ Illuminate\Support\Str::title(auth()->user()->first_name) }} {{ Illuminate\Support\Str::title(auth()->user()->last_name) }}</h5>
                        <h5><b>Email:</b> {{ auth()->user()->email }}</h5>
                        <a href="#modalSM" class="mb-1 mt-1 me-1 modal-sizes btn btn-sm btn-primary">Top up wallet</a>
                        <div id="modalSM" class="modal-block modal-block-sm mfp-hide">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title">Wallet Top-up</h2>
                                </header>
                                <div class="card-body">
                                    <div class="modal-wrapper">
                                        <form id="paymentForm" class="form-horizontal form-bordered" method="POST">
                                            @csrf
                                            @method('POST')

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                                                <div class="col-lg-6">
                                                    <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter top up amount">
                                                    <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                                    <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="payment_for" value="wallet-top-up">
                                                    <input type="hidden" name="payment_type" value="online-gateway">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button class="btn btn-primary" type="submit" id="submit" onclick="handleProceed()">Proceed</button>
                                            <button class="btn btn-default modal-dismiss">Cancel</button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </div>
                        <div id="modalMD" class="modal-block modal-block-md mfp-hide">
                            <section class="card">
                                <header class="card-header">
                                    <h2 class="card-title">Wallet Top-up</h2>
                                </header>
                                <div class="card-body">
                                    <div class="modal-wrapper">
                                        
                                        <section class="card">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <h3><strong>Bank Transfer</strong></h3>
                                                <p style="color: black">Kindly make a bank transfer to the account details below, input the amount and upload a screenshot of the payments receipt</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                                            </div>
                                        </section>

                                        <form id="pay" action="{{ route('payment.store') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Bank Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="Palmpay" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Number &nbsp; <span id="copyText">(Click to copy)</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="8164418223" id="accountNumber" class="form-control" readonly="readonly">                         
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var copyText = document.getElementById('copyText');
                                                        var inputReadOnly = document.getElementById('accountNumber');
                                                
                                                        inputReadOnly.addEventListener('click', function() {
                                                            inputReadOnly.select();
                                                            document.execCommand('copy');
                                                            copyText.textContent = 'Copied!';
                                                            copyText.classList.add('green-text');
                                                            setTimeout(function() {
                                                                copyText.textContent = '(Click to copy)';
                                                                copyText.classList.remove('green-text');
                                                            }, 3000); // Reset to original text after 1.5 seconds
                                                        });
                                                    });
                                                </script>
                                            </div>

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Name</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="Umukoro Famous" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                
                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Amount</label>
                                                <div class="col-lg-6">
                                                    <input type="number" name="amount" class="form-control" id="amountInput" placeholder="Enter top up amount">
                                                    <input type="hidden" name="email" id="email" value="{{ auth()->user()->email }}">
                                                    <input type="hidden" name="userid" id="userid" value="{{ auth()->user()->id }}">
                                                    <input type="hidden" name="payment_for" value="wallet-top-up">
                                                    <input type="hidden" name="payment_type" value="manual-transfer">
                                                </div>
                                            </div>

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Receipt Screenshot</label>
                                                <div class="col-lg-6">
                                                    <input type="file" name="screenshot" class="form-control" accept="image/jpeg, image/jpg, image/png">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            {{-- <button onclick="proceedWithPayment()" class="btn btn-primary modal-confirm">Proceed</button> --}}
                                            <button type="submit" class="btn btn-primary modal-confirm" onclick="event.preventDefault(); document.getElementById('pay').submit();">Proceed</button>
                                            <button class="btn btn-default modal-dismiss">Cancel</button>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $vpayApiKey = env('VPAY_API_KEY');
    $vpayApiDomain = env('VPAY_API_DOMAIN');
@endphp

<script src="https://dropin-sandbox.vpay.africa/dropin/v1/initialise.js"></script>

<script>
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    function generateTransactionRef() {
        const timestamp = Date.now();
        const randomNum = Math.floor(Math.random() * 1000000);
        return `trx-${timestamp}-${randomNum}`;
    }

    function handleProceed() {
        const amount = document.getElementById('amount').value;
        const email = document.getElementById('email').value;
        const userId = document.getElementById('userid').value;
        const payment_for = 'wallet-top-up';
        const payment_type = 'online-gateway';
        const transactionref = generateTransactionRef();

        const options = {
            domain: '{{ $vpayApiDomain }}',
            key: '{{ $vpayApiKey }}',
            amount: amount,
            email: email,
            transactionref: transactionref,
            customer_service_channel: '+2348164418223, support@famcraft.ng',
            txn_charge: 6,
            txn_charge_type: 'flat', // or 'percentage'
            onSuccess: function(response) { 
                console.log('Transaction Successful!', response);
                // response.email = email;
                // response.amount = amount;
                // response.userId = userId;
                // response.transactionref = transactionref;
                // response.payment_for = payment_for;
                // response.payment_type = payment_type;
                // fetch('/payment-status', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': getCsrfToken()
                //     },
                //     body: JSON.stringify(response)
                // })
                // .then(response => {
                //     if (!response.ok) {
                //         throw new Error(`HTTP error! status: ${response.status}`);
                //     }
                //     return response.json();
                // })
                // .then(data => console.log(data))
                // .catch(error => console.error('Error:', error));
            },
            onExit: function(response) { 
                console.log('Transaction Cancelled or Failed!', response);
            }
        };

        const dropinInstance = window.VPayDropin.create(options);
        dropinInstance.open();
    }
</script>
