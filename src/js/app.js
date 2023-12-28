

const botonGenerarPDF = document.querySelector('#btnGeneradorPDF');

/**ELEMENTOS PARA LA SECCION DE DISEÑO DEL CATALOGO */
const botonCheckBordes = document.querySelector('#check-bordes');
const botonCheckPrecios = document.querySelector('#check-precios');
const selectColumnas = document.querySelector('#select-columnas');

let numeroColumnas = 4;
let muestraBordes = 1;
let muestraPrecios = 1;

let contenedorProductos = document.querySelector('#contenedor-productos');
let cards = document.getElementsByClassName('card-producto');

/**ELEMENTOS PARA LA SECCION DE EMPRESA */
let botonEditarEmpresa = document.querySelector('#btn-editar-empresa');
let botonGuardar = document.querySelector('#btn-guardar');
let inputIdEmpresa = document.querySelector('#input-id-empresa');
let inputprueba = document.querySelector('#prueba');


//BUSCADOR
let botonBuscarProductos = document.querySelector('#btn-buscar-productos');
let selectCategoria = document.querySelector('#select-categoria');
if(botonBuscarProductos!==null){
    botonBuscarProductos.href="/catalogos-php/admin/elementos/catalogos.php?codigo=1&categoria=-1";
}

//INPUT QUE ENVIARA EL VALOR DE LA CATEGORIA AL ARCHIVO QUE CREA EL CATALOGO
let inputCategoria = document.querySelector('#input-categoria');

if(inputCategoria !== null){
    selectCategoria.addEventListener('change', ()=>{
        let seleccion = selectCategoria.value;
        console.log('valor: ' + seleccion);
        botonBuscarProductos.href="";
        botonBuscarProductos.href="/catalogos-php/admin/elementos/catalogos.php?codigo=1&categoria=" + seleccion;
    
        inputCategoria.value = ''+ seleccion;
    
    })
}

if(inputIdEmpresa !==null){
    if(inputIdEmpresa.value !== ""){
        //alert('hay datos' + inputIdEmpresa.value);
        //botonEditarEmpresa.removeAttribute('class');
        //botonEditarEmpresa.classList.add('boton--oculto');
        botonEditarEmpresa.disabled = false;
        botonEditarEmpresa.addEventListener('click', ()=>{
            
            let entradas = document.querySelectorAll('.formulario__input');
            //console.log(entradas);
            for(let i = 0; i<entradas.length; i++){
                entradas[i].disabled = false;
            }
            botonEditarEmpresa.disabled = true;
            botonGuardar.disabled = false;
        })
    
    }else{
        botonEditarEmpresa.disabled = true;
    }
}

/*
//botonGenerarPDF.addEventListener('click', printPDF);
botonGenerarPDF.addEventListener('click', ()=>{
    const elementoParaConvertir = contenedorProductos;

    html2pdf()
        .set({
            margin:0,
            filename: 'documento.pdf',
            image: {
                type: 'png',
                quality: 0.98
            },
            html2canvas:{
                scale: 3,
                letterRendering: true
            },
            jsPDF:{
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        })
        .from(elementoParaConvertir)
        .save()
        .catch(err=>console.log(err))
        .finally()
        .then(()=>{
            console.log('guardado')
        })
});

botonCheckBordes.addEventListener('click', ()=>{        
        // for(var i = 0; i<cards.length; i++){
        //     cards[i].classList.toggle('no-borde');
        // }

        if(botonCheckBordes.checked){
            for(var i = 0; i<cards.length; i++){
                 cards[i].classList.remove('no-borde');
                 cards[i].classList.add('borde');
            }
        }else{
            for(var i = 0; i<cards.length; i++){
                cards[i].classList.remove('borde');
                cards[i].classList.add('no-borde');
           }
        }

})

seleccionColumnas.addEventListener('change', ()=>{
    if(seleccionColumnas.value === '2'){
        contenedorProductos.classList.remove('grid-3col');
        contenedorProductos.classList.remove('grid-4col');

        contenedorProductos.classList.add('grid-2col')
    }

    if(seleccionColumnas.value === '3'){
        contenedorProductos.classList.remove('grid-2col');
        contenedorProductos.classList.remove('grid-4col');

        contenedorProductos.classList.add('grid-3col')
    }

    if(seleccionColumnas.value === '4'){
        contenedorProductos.classList.remove('grid-2col');
        contenedorProductos.classList.remove('grid-3col');

        contenedorProductos.classList.add('grid-4col')
    }
})

function getPDF() {
    var pdf = new jsPDF('p','pt','a4');
    pdf.addHTML($('#catalogo')[0], () => {
        pdf.save('filename.pdf');
    });

    
}

function printPDF(){
    window.print();
}*/
