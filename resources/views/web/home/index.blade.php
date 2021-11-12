<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/favicon.ico')}}">

    <title>Welcome to CEGA Elections</title>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.css')}}">
</head>
<style>

    .myClass {
        width: 400px !important;;
        height: 200px !important;;
    }

    .nominee {
        cursor: pointer;
    }

    .nominee:active {
        background-color: #ffffff;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

    @media screen and (max-width: 766px) {
        #tick {
            display: none;
        }
    }

    @media screen and (max-width: 740px) {
        .card-radio {
            display: inline-block;
        }
    }

    @media screen and (min-width: 740px) {
        input[type=radio] {
            border: 0px;
            width: 40%;
            height: 1.8em;
        }

    }

    @media screen and (max-width: 850px) {
        .card-img-right {
            display: none;
        }
    }

    .swal-text {
        padding: 17px;
        border: 1px solid #F0E1A1;
        display: block;
        margin: 22px;
        text-align: center;
        color: #61534e;
        font-weight: bold;
    }
</style>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">

            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">CAST YOUR VOTE</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a href="{{route('web::logout')}}" class="btn btn-outline-info">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        @if(!auth()->user()->vote_casted)
            <form method="POST" action="{{route('web::cast.vote')}}" id="voteForm">
                @csrf
                <input type="hidden" name="voter_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                @foreach($categories as $category)
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-secondary" id="{{$category->name}}">
                                <h2 class="mb-0">
                                    <button class="btn btn-secondary bg-gradient-secondary text-left" type="button"
                                            data-toggle="collapse"
                                            data-target="#collapse-{{$category->id}}" aria-expanded="true"
                                            aria-controls="collapse-{{$category->id}}">
                                        {{$category->name}}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse-{{$category->id}}" class="collapse @if($loop->first) show @endif"
                                 aria-labelledby="{{$category->name}}"
                                 data-parent="#accordionExample">
                                <div class="card-body">
                                    @include('web.home.card')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <button type="button" class="btn btn-block btn-success bg-gradient-success" data-form="#voteForm"
                        data-count="{{count($categories)}}"
                        id="cast-vote">Cast My Vote
                </button>
            </form>
        @else
            <div class="jumbotron p-3 p-md-5 text-white rounded bg-success bg-gradient-success row">
                <div class="col-md-8 px-0">
                    <h1 class="display-4 font-italic">You Have successfully casted your vote</h1>
                    From IP : {{auth()->user()->ip_address}}<br>
                    Latitude : {{auth()->user()->latitude}}<br>
                    Longitude : {{auth()->user()->longitude}}
                </div>
                <div class="col-md-4" id="tick">
                    <h1 class="text-white ml-4" style="font-size: 200px;"><i class="fa fa-check-circle"></i></h1>
                </div>
            </div>
        @endif
    </div>
</div>

<footer class="blog-footer">

</footer>
<script src="{{asset('js/toast.js')}}"></script>
<script>
    $(document).ready(function () {
        getLocation();
    });


    $('#cast-vote').on('click', function (e) {
        let totalCategories = $(this).data('count');
        let checked = $(":radio:checked").length;
        let $form = $($(this).data('form'));
        let url = $form.attr('action');
        if (totalCategories !== checked) {
            swal({
                title: 'Error!',
                text: 'Please Select nominee from each category!',
                icon: 'warning',
                button: "Ok!"
            });
        } else {
            $.ajax({
                url: url,
                type: "POST",
                data: $form.serialize(),
                success: function (response) {
                    let html = `Your Vote ID : ${response[0].vote_id}\n`;
                    html += 'Votes casted to :\n';
                    for (key in response[0].vote_value) {
                        html += `${key} : ${response[0].vote_value[key]}\n`;
                    }
                    swal({
                        title: "Vote Casted successfully!",
                        text: html,
                        icon: "success",
                        buttons: {
                            cancel: {
                                text: "Please take a screenshot for your reference",
                                value: null,
                                visible: true,
                                className: ['btn', 'btn-link', 'text-muted', 'disabled'],
                                closeModal: true,
                            },
                            confirm: {
                                text: "Download PDF!",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            }
                        },
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.open(response[0].pdf_url, 'window name', 'window settings');
                                location.reload();
                            } else {
                                window.open(response[0].pdf_url, 'window name', 'window settings');
                                location.reload();
                            }
                        });
                }
            });
        }
    })


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
    }

    $(document).on('click', '#manifesto', function (e) {
        e.preventDefault();
        let text = $(this).data('text');
        swal({
            title: 'Manifesto',
            text: text,
            customClass: "myClass",
        });
    });

    $(document).on('click', '.nominee', function (e) {
        let nominee = $(this).data('nominee');
        let category = $(this).data('category');
        $(`#radio-${category}-${nominee}`).prop('checked', true);
    });
</script>
</body>
</html>
