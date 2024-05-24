<!doctype html>
<html class="left-sidebar-panel sidebar-light">
	<head>

		<title>Basic NIN Slip | FamCraft Technologies</title>
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('img/logos/favicon.png') }}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{ asset('img/logos/favicon.png') }}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/boxicons/css/boxicons.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/jquery-ui/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/jquery-ui/jquery-ui.theme.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/morris/morris.css') }}" />
		<link rel="stylesheet" href="{{ asset('admin/vendor/simple-line-icons/css/simple-line-icons.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/skins/default.css') }}" />

		<!-- Head Libs -->
		<script src="{{ asset('admin/vendor/modernizr/modernizr.js') }}"></script>

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
	</head>

    <style>
        .image-container{
            padding: 0px 80px 20px 80px !important;
            margin-right: 0px !important;
        }
    </style>

    <body onload="downloadPDF()">
		<section role="main" class="content-body card-margin image-container">
            <div class="row">
                <div class="col">
                    <section class="card card-airtime">
                        <header class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <img src="{{ asset('img/logos/nimc2.jpg') }}" width="100" alt="NIMC" />
                                </div>
                                <div>
                                    <h2 class="card-title" style="margin-top: 45px">Basic NIN Slip</h2>
                                </div>
                            </div>          
                        </header>
                        <div class="card-body">
                            <form class="form-horizontal form-bordered" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6">
                                        @isset($data['photo'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Photo <span style="color: red"> *</span></label>
                                                <div class="col-lg-6">
                                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                                        <div class="thumbnail">
                                                            <div class="thumb-preview">
                                                                <a class="thumb-image" href="data:image/jpeg;base64,{{ base64_encode($data['photo']) }}" target="_blank">
                                                                    <img src="data:image/jpeg;base64,{{ base64_encode($data['photo']) }}" class="img-fluid">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['nin'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">NIN</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['nin'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['trackingId'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Tracking ID</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['trackingId'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['title'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Title</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['title'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['surname'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Surname</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['surname'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['firstname'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Firstname</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['firstname'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['middlename'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Middlename</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['middlename'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['gender'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Gender</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['gender'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset
                                    </div>

                                    <div class="col-6">
                                        @isset($data['birthdate'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Birth Date</label>
                                                <div class="col-lg-6">
                                                    <input type="text" name="dob" value="{{ $data['birthdate'] ?? null }}" class="form-control" id="inputDefault" readonly="readonly">
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['state'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Residence State</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['state'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['lg'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Residence LG</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['lg'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['restown'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Residence Town</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['restown'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset
                        
                                        @isset($data['address'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Address</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['address'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['birthstate'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Birth State</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['birthstate'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['birthlga'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Birth LGA</label>
                                                <div class="col-lg-6">
                                                    <input type="text" value="{{ $data['birthlga'] ?? null}}" id="inputReadOnly" class="form-control" readonly="readonly">                         
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['signature'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">Signature <span style="color: red"> *</span></label>
                                                <div class="col-lg-6">
                                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                                        <div class="thumbnail">
                                                            <div class="thumb-preview">
                                                                <a class="thumb-image" href="data:image/jpeg;base64,{{ base64_encode($data['signature']) }}" target="_blank">
                                                                    <img src="data:image/jpeg;base64,{{ base64_encode($data['signature']) }}" class="img-fluid">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endisset

                                        @isset($data['nin'])
                                            <div class="form-group row pb-4">
                                                <label class="col-lg-4 control-label text-lg-end pt-2" for="inputDefault">QR Code <span style="color: red"> *</span></label>
                                                <div class="col-lg-6">
                                                    <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative; height: auto;">
                                                        <div class="thumbnail">
                                                            <div class="thumb-preview">
                                                                <img src="{{ asset('storage/qrimages/qr_' . $data['nin'] . '.png') }}" alt="QR Code" class="smallimage">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
		</section>

        <script>
            function downloadPDF() {
                var element = document.querySelector('.image-container'); // Change the selector to match your container
                var opt = {
                    margin: 0, // Adjust margin as needed
                    filename: '{{ $data['nin'] }}_basic_slip.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                };
                html2pdf().from(element).set(opt).save();
            }
        </script>
	</body>
</html>

