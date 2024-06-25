
window.addEventListener('load',function(){

let modal = document.getElementById('modal-imagen');
let divmodal = document.getElementById('container-modal');
let buttoncerrar = document.getElementById('cerrarModal');
 let offset = 0;




/*QUITA EL MODAL */
buttoncerrar.addEventListener('click',function(){
    divmodal.innerHTML = '';
    modal.setAttribute('style','display:none');
})  

const marcadorDOM = document.querySelector("#marcador");
// Creamos un objeto IntersectionObserver
const observerCuadrado = new IntersectionObserver((entries) => {
	// Comprobamos todas las intesecciones. En el ejemplo solo existe una: cuadrado
	entries.forEach((entry) => {
		// Si es observable, entra
		if (entry.isIntersecting) {
			// Aumentamos la pagina actual
            
			cargarImagenes();
            offset += 6;


		}
	});
});

// Añado a mi Observable que quiero observar. En este caso el cuadrado
observerCuadrado.observe(marcadorDOM);

function cargarImagenes() {

    $.ajax({
        method:'POST',
        url:`/blackrony/public/scroll`,
        data:{offset},
        success: function(response){
            const galeria = document.getElementById('container-modelos');
            response.imagenes.forEach(imagen => {
                const divModelos = document.createElement('div');
                divModelos.setAttribute('class','div-modelos')
                galeria.appendChild(divModelos);
                const imgElement = document.createElement('img');
                imgElement.setAttribute('class','imagen-modelo')
                imgElement.setAttribute('data-id',imagen[0])
                imgElement.src = 'img/modelo/'+imagen[1];
                divModelos.appendChild(imgElement);
            });
            
        let imagenes  = document.querySelectorAll('.imagen-modelo')
          
        /* ROPA DE LOS MODAL */
        for(let i=0;i<imagenes.length;i++){
            imagenes[i].addEventListener('click',function(){
                let atributo = modal.getAttribute('style');
                if(atributo != 'display:flex'){
                    const imageId = imagenes[i].getAttribute('data-id');
                    fetch(`modelos/${imageId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data)
                            for(let i=0; i<data.length ;i++){
                                divmodal.innerHTML += 
                                    `<div class='ropa2'>
                                    <img class='imgropa' src='img/ropa/`+data[i][3]+`'>
                                    <h2>`+data[i][1]+' '+data[i][2]+`€</h2>
                                    <a href='carrito/agregar/`+data[i][0]+`' class='agregarCarrito'>Agregar al carrito</a>
                                    </div>`
                            }
                        +`</div>`
                        modal.setAttribute('style','display:flex');
                    })
                }
            })}
        }
        
})
}
})