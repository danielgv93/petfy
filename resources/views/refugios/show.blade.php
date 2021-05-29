@extends('layouts.master.master')

@section('title')
    Refugio
@endsection

@section('main')
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("refugio.show", $refugio) }}
    <div class="">
        <div class="row justify-content-center">
            <div class="col-6 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <h3 class="card-title text-center">{{$refugio->name}}</h3>
                            <h5 class="card-title text-center">Email de contacto: {{$refugio->email}}</h5>
                            <!-- Direccion -->
                            <h5 class="card-title text-center">
                                @if ($refugio->direccion != "")
                                    Direccion: {{$refugio->direccion}}
                                @endif
                                @if ($refugio->ciudad != "" && $refugio->direccion != "")
                                    , {{$refugio->ciudad}}
                                @elseif($refugio->ciudad != "")
                                    Ciudad: {{$refugio->ciudad}}
                                @endif
                            </h5>
                            <h5 class="card-title text-center" id="donaciones" >
                                @if (!empty($refugio->direccion_donacion))
                                    Dirección de donaciones: <span class="copy-click" data-tooltip-text="Haz click para copiar"
                                                                   data-tooltip-text-copied="✔ Copiado">{{$refugio->direccion_donacion}}</span>
                                @endif
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="card" id="mapa"></div>
        </div>
    </div>
    <script>
        const links = document.querySelectorAll('.copy-click');
        const cls = {
            copied: 'is-copied',
            hover: 'is-hovered' };


        const copyToClipboard = str => {
            const el = document.createElement('input');
            str.dataset.copyString ? el.value = str.dataset.copyString : el.value = str.innerText;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.opacity = 0;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        };

        const clickInteraction = e => {
            e.preventDefault();
            copyToClipboard(e.target);
            e.target.classList.add(cls.copied);
            setTimeout(() => e.target.classList.remove(cls.copied), 1000);
            setTimeout(() => e.target.classList.remove(cls.hover), 700);
        };

        Array.from(links).forEach(link => {
            link.addEventListener('click', e => clickInteraction(e));
            link.addEventListener('keypress', e => {
                if (e.keyCode === 13) clickInteraction(e);
            });
            link.addEventListener('mouseover', e => e.target.classList.add(cls.hover));
            link.addEventListener('mouseleave', e => {
                if (!e.target.classList.contains(cls.copied)) {
                    e.target.classList.remove(cls.hover);
                }
            });
        });
    </script>
    <script>
        var customLabel = {
            refugio: {
                label: 'R'
            }
        };

        function initMap() {
            var map = new google.maps.Map(document.getElementById('mapa'), {
                center: new google.maps.LatLng(43.24827561100313, -4.039139052724816),
                zoom: 9
            });
            var infoWindow = new google.maps.InfoWindow;

            // Change this depending on the name of your PHP or XML file
            downloadUrl("{{url("maps/generar/$refugio->id")}}", function (data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function (markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        label: icon.label
                    });
                    marker.addListener('click', function () {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            });
        }


        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function () {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        function doNothing() {
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiXfV7kjZomsJ04JKGS2-Kx1Z6WIsdzC4&callback=initMap">
    </script>
@endsection
