@extends('layouts.nav')

@section('content')
<body>
    <div class="container-fluid mt-5">
        <section>
            <h1>About Us</h1>
            <div class="about-us">
                <p>Discover the heart of cinema at Spectacles.com, where passion intertwines with critique. Immerse yourself
                    in our precise dissection of films, presenting nuanced reviews that transcend the superficial. Whether
                    exploring timeless classics or the latest releases, we exalt the art of storytelling. Embark with us on
                    a journey through the expansive cinematic landscape, where each frame narrates a unique tale.</p>
            </div>
        </section>
        <section>
            <h2>Meet the Developers</h2>
            <div class="dev-container">
                <div class="developer-profile">
                    <div class="developer-info">
                        <img src="../../images/elghene.jpg" alt="Developer 1" class="developer-image">
                        <p class="developer-name">Elghene Maglaque</p>
                        <a href="mailto:elghenemaglaque@gmail.com" class="developer-email">elghenemaglaque@gmail.com</a>
                    </div>
                    <div class="developer-info">
                        <img src="../../images/mattformal.jpg" alt="Developer 2" class="developer-image">
                        <p class="developer-name">Matthew Astrera</p>
                        <a href="mailto:matthewastrera@gmail.com" class="developer-email">matthewastrera@gmail.com</a>
                    </div>
                    <div class="developer-info">
                        <img src="../../images/renzformal2.jpg " alt="Developer 3" class="developer-image">
                        <p class="developer-name">Renz Ravela</p>
                        <a href="mailto:renzravela@gmail.com" class="developer-email">renzravela@gmail.com</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@endsection
