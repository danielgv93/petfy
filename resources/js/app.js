require('./bootstrap');

require('alpinejs');
import Swal from 'sweetalert2';

import $ from "jquery";

window.aceptarSolicitud = function(mascota, familia, imagen)
{
    var cargando = '<div class="loader loader--style2" title="1">\n' +
        '  <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\n' +
        '     width="60px" height="60px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">\n' +
        '  <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">\n' +
        '    <animateTransform attributeType="xml"\n' +
        '      attributeName="transform"\n' +
        '      type="rotate"\n' +
        '      from="0 25 25"\n' +
        '      to="360 25 25"\n' +
        '      dur="0.6s"\n' +
        '      repeatCount="indefinite"/>\n' +
        '    </path>\n' +
        '  </svg>\n' +
        '</div>'
    Swal.fire({
        imageUrl: imagen,
        html: '¿Quieres realmente aceptar la solicitud que ha hecho <strong>' + familia + "</strong> por <strong>" + mascota + "</strong>",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ff5364',
        cancelButtonColor: '#35495e',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: window.location.origin + "/dashboard/peticiones-adopcion/aceptar-peticion/" + mascota + "/" + familia,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    Swal.fire({
                        html: cargando + '<h5>Procesando adopción...</h5>',
                        showConfirmButton: false,
                    });
                },
                success: function (json) {
                    Swal.fire({
                        icon : "info",
                        html : json.mensaje,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#ff5364',
                    }).then((result) => {
                        if (result.isConfirmed) window.location = window.location.origin + "/dashboard/peticiones-adopcion";
                    });
                }
            })
        }
    });
}

window.borrarMascota = function(mascota, form)
{
    Swal.fire({
        icon: 'warning',
        text: '¿Quieres borrar definitivamente a <strong>' + mascota + '</strong>?',
        showCancelButton: true,
        confirmButtonText: 'Borrar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ff5364',
        cancelButtonColor: '#35495e',
    }).then((result) => {
        if (result.isConfirmed) {
            let formulario = document.getElementById(form);
            let tokenForm = formulario[0].value;
            let idForm = formulario[1].value;
            console.log(tokenForm)
            $.ajax({
                url: window.location.origin + "/mascota/adoptar",
                data: {
                    _token: tokenForm,
                    id: idForm
                },
                type: "POST",
                dataType: "json",
                success: function (json) {
                    let codigo = json.respuesta;
                    let mensajes = [
                        "No puedes solicitar otra adopción por " + mascota +". Ya lo has hecho anteriormente.",
                        mascota + " parece que esta muy solicitado. Has enviado una solicitud de adopción.",
                        "Has enviado una solicitud de adopción por " + mascota +"."
                    ]
                    Swal.fire({
                        icon : "info",
                        text : mensajes[codigo],
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#ff5364',
                    });
                }
            })
        }
    });
}

window.enviarSolicitud = function(mascota, form)
{
    Swal.fire({
        icon : 'question',
        html: '¿Quieres solicitar la adopción de <strong>' + mascota + '</strong>?',
        showCancelButton: true,
        confirmButtonText: 'Solicitar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ff5364',
        cancelButtonColor: '#35495e',
    }).then((result) => {
        if (result.isConfirmed) {
            let formulario = document.getElementById(form);
            let tokenForm = formulario[0].value;
            let idForm = formulario[1].value;
            console.log(tokenForm)
            $.ajax({
                url: window.location.origin + "/mascota/adoptar",
                data: {
                    _token: tokenForm,
                    id: idForm
                },
                type: "POST",
                dataType: "json",
                success: function (json) {
                    let codigo = json.respuesta;
                    let mensajes = [
                        "No puedes solicitar otra adopción por " + mascota +". Ya lo has hecho anteriormente.",
                        mascota + " parece que esta muy solicitado. Has enviado una solicitud de adopción.",
                        "Has enviado una solicitud de adopción por " + mascota +"."
                    ]
                    Swal.fire({
                        icon : "info",
                        text : mensajes[codigo],
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#ff5364',
                    }).then((result) => {
                        if (result.isConfirmed) window.location = window.location.origin + "/mascotas";
                    });
                }
            })
        }
    });
}

function convertToSlug(text) {
    text = text.normalize("NFD") // Normalizamos para obtener los códigos
        .replace(/[\u0300-\u036f|.,\/#!$%\^&\*;:{}=\-_`~()]/g, "") // Quitamos los acentos y símbolos de puntuación
        .replace(/ +/g, '-') // Reemplazamos los espacios por guiones
        .toLowerCase(); // Todo minúscula
    return text;
}
