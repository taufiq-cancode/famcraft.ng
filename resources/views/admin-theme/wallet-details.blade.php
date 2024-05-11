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
                        <a href="#modalMD" class="mb-1 mt-1 me-1 modal-sizes btn btn-sm btn-primary">Top up wallet</a>
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
                                                    <input type="text" value="Moniepoint" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>

                                            <div class="form-group row pb-2">
                                                <label class="col-lg-3 control-label text-lg-end pt-2" for="inputDefault">Account Number &nbsp; <span id="copyText">(Click to copy)</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="0223611578" id="accountNumber" class="form-control" readonly="readonly">                         
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
                                                    <input type="text" value="Famcraft Technologies" id="inputReadOnly" class="form-control" readonly="readonly">                         
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

{{-- <script>
    function proceedWithPayment() {
        // Read form data
        const amount = document.getElementById('amountInput').value;
        const email = document.getElementById('email').value;
        const userId = document.getElementById('userid').value;

        const options = {
            amount: amount,
            currency: 'NGN', // Assuming currency is always NGN
            domain: 'sandbox',
            key: '{{ env('VPAY_KEY') }}', // Accessing key from .env file
            email: email,
            transactionref: generateUniqueTransactionRef(), // Function to generate a unique transaction reference
            customer_logo: 'https://www.vpay.africa/static/media/vpayLogo.91e11322.svg',
            customer_service_channel: '+2348030007000, support@org.com',
            txn_charge: 6,
            txn_charge_type: 'flat',
            onSuccess: function(response) { 
                console.log('Payment successful!', response.message); 
                // Handle success in Laravel backend if needed
            },
            onExit: function(response) { 
                console.log('Payment cancelled or failed!', response.message); 
                // Handle exit in Laravel backend if needed
            }
        }

        if (window.VPayDropin) {
            const { open } = VPayDropin.create(options);
            open();                    
        }
    }
</script> --}}
