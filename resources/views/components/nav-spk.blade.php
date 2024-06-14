
<style>
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        width: 40px;
        margin-top: -10px;
        margin-left: 50px;
    }

    .navbar-nav .nav-link {
        color: #333;
        font-weight: bold;
        margin-right: 15px;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
    }

    .container {
        padding-top: 70px;
    }

    .btn-primary, .btn-danger {
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .card {
        margin-bottom: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
    }

    input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 10px;
    }

    h1 {
        margin-bottom: 20px;
        color: #333;
    }

    .btn-home:hover{
        color: #007bff;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">
        <img src="../images/logoo.png" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <form action="{{ route('back.home') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-home" style="background-color: white; border:none;" >Home</button>
            </form>
        </ul>
    </div>
</nav>
