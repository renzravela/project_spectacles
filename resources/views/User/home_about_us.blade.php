@extends('layouts.nav')

@section('content')
<body class="bg-dark bg-opacity-50">
    <div class="container-fluid mt-3">
        <section class="text-center mb-5">
            <h1 class="mb-4">About Us</h1>
            <div class="about-us container" style="">
                <p>Discover the heart of cinema at Spectacles.com, where passion intertwines with critique. Immerse yourself
                    in our precise dissection of films, presenting nuanced reviews that transcend the superficial. Whether
                    exploring timeless classics or the latest releases, we exalt the art of storytelling. Embark with us on
                    a journey through the expansive cinematic landscape, where each frame narrates a unique tale.</p>
            </div>
        </section>
        <section class="text-center">
            <h2 class="mb-4">Meet the Developers</h2>
            <div class="dev-container d-flex justify-content-center" id="content">
                <div class="developer-profile">
                    <div class="developer-info">
                        <img src="{{ asset('assets/images/pic1.png') }}" alt="Developer 1" class="developer-image">
                        <p class="developer-name"><strong>Elghene Maglaque</strong></p>
                        <a href="mailto:elghenemaglaque@gmail.com" class="developer-email" style="color: rgb(255, 255, 255);">elghenemaglaque@gmail.com</a>
                    </div>
                </div>
                <div class="developer-profile">
                    <div class="developer-info">
                        <img src="{{ asset('assets/images/pic2.png') }}" alt="Developer 2" class="developer-image">
                        <p class="developer-name"><strong>Kenneth Basinga</strong></p>
                        <a href="mailto:basingakenneth@gmail.com" class="developer-email" style="color: rgb(255, 255, 255);">basingakenneth@gmail.com</a>
                    </div>
                </div>
                <div class="developer-profile">
                    <div class="developer-info">
                        <img src="{{ asset('assets/images/pic3.jpg') }}" alt="Developer 3" class="developer-image">
                        <p class="developer-name"><strong>Renz Ravela</strong></p>
                        <a href="mailto:renzravela@gmail.com" class="developer-email" style="color: rgb(255, 255, 255);">renzravela@gmail.com</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        .developer-image{
            width: 200px; 
            height:200px;
            border-radius: 100px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .developer-profile{
            margin: 20px;
        }
        .about-us{
            text-align: justify;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;  
        }
    </style>
</body>
@endsection
