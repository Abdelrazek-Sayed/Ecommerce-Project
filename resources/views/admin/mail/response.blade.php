 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>

 <body>
     <div class="container">
         <div class="card">
             <div class="card-header">
                 <p> From : {{ 'EcoWeb@bezo.com' }}</p>
                 {{-- <p> To : {{ $email }}</p> --}}

             </div>
             <div class="card-body">
                 <h2>Dear :{{ $name }}</h2>

                 <h4> Title : {{ $title }}</h4>
                 <p> {{ $body }}</p>


             </div>

         </div>
     </div>



 </body>

 </html>
