<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <title>@yield('title')</title>

        <style>

        
          .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
          }

          .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
          }


          .btn{
            margin-top:30px;
            margin-bottom:30px;
            margin-left:auto;
            margin-right:auto;

          }

          #sidebarMenu{
            height: 100vw !important;
            background-color : rgb(19,41,61) 


          }
          a{
            color : white !important;


          }
         
         

          </style>

          @yield('style')

    </head>
    


    <body class="">
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3 mb-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Ordem de serviço</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </header>
      
      
    <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/novaOS">
              
              Nova Os
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/consultar">
              
              Consultar
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              
              Clientes
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/listarOS">
              
              Busca por tipo
            </a>
          </li>
         
        </ul>       
      </div>
    </nav> 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @yield('content')
    </main>   
    </div>
</div>






     
    
    </body>


    <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</html>
