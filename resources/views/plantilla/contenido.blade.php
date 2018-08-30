@extends('principal')
@section('contenido')
<template v-if="menu==0">
        <main class="main">
            <!-- Breadcrumb -->
    
            <div class="container-fluid texte-center">
                <div class="card container">
                    <div class="card-header">
                        Bienvenido
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                        ea commodo consequat.
                    </div>
                </div>
            </div>
        </main>
</template>
<template v-if="menu==1">
    <genero></genero>
</template>
<template v-if="menu==2">
    <rol></rol>
</template>
<template v-if="menu==3">
    <ciclo></ciclo>
</template>
<template v-if="menu==4">
    <dia></dia>
</template>
    

@endsection