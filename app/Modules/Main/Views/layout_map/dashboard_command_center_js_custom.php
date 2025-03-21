<script>
    // MAP
    // jalan
    async function showJalan() {
        map.on('load', async function() {
            let responseJalan = await getData("/street/list");
            if (responseJalan.status_code == 200) {
                let jsonJalan = responseJalan.data;
                for (let i = 0; i < jsonJalan.length; i++) {
                    let el = jsonJalan[i];
                    let id = i;
                    let geojsonData = JSON.parse(el.geojson);

                    // let coordinates = getFirstAndLastCoordinates(geojsonData);
                    // let origin = coordinates.firstCoordinate[1] + ',' + coordinates.firstCoordinate[0];
                    // let destination = coordinates.lastCoordinate[1] + ',' + coordinates.lastCoordinate[0];
                    // let responseJalanTraffic = await getData(`/data-traffic-google?origin=${origin}&destination=${destination}`);

                    // if (responseJalanTraffic.status_code == 200) {
                    //     let jsonJalanTraffic = responseJalanTraffic.data;
                    // }

                    map.addSource(`sourceGeoJsonJalan_${id}`, {
                        'type': 'geojson',
                        'data': geojsonData
                    });

                    map.addLayer({
                        'id': `layerJalan_${id}`,
                        'type': 'line',
                        'source': `sourceGeoJsonJalan_${id}`,
                        'layout': {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        'paint': {
                            'line-color': 'yellow',
                            'line-width': 5
                        }
                    });
                    onClickKmlMap(`layerJalan_${id}`, `Jalan`, el);
                }
            }

            // GET LIST TRAFFIC
            // let responseJalanTraffic = await getData(`/data-traffic-google?origin=${origin}&destination=${destination}`);
            let responseJalanTraffic = await getData(`/traffic/list/all`);
            if (responseJalanTraffic.status_code == 200) {
                responseJalanTraffic.data.map(async function(data) {


                    const locationName = data.name || 'Tidak Diketahui';
                    
                    let originData = data.latlng_start.split(',');
                    originData.reverse();

                    const popupContentOrigin = `
                        <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                            <span>Detail Titik</span>
                            <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                                <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                            </div>
                        </div>
                        <div class= w-100 d-flex justify-content-center">
                            <div>
                                <table style="font-size: x-small;">
                                    <tr>
                                        <td><span>Koordinat </span></td>
                                        <td>: </td>
                                        <td><span>${originData[1]}, ${originData[0]}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lokasi </td>
                                        <td>: </td>
                                        <td><span>${locationName}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Chart Traffic </td>
                                        <td>: </td>
                                        <td>
                                            <a href="javascript:void(0)" style="padding: 3px;" 
                                                data-traffic='${JSON.stringify(data)}'
                                                class="btn btn-sm btn-outline-success open-chart-traffic">
                                                <i class="fa-solid fa-traffic-light"></i> Open</a>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    `;
                    
                    let islngLatOrigin = `${originData[1]}_${originData[0]}`;
                    addMarker(originData, `trafficFlowGoogleMarker_${islngLatOrigin}`, 'Titik Penanda', popupContentOrigin);

                    let destinationData = data.latlng_end.split(',');
                    destinationData.reverse();

                    const popupContentDestination = `
                        <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                            <span>Detail Titik</span>
                            <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                                <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                            </div>
                        </div>
                        <div class= w-100 d-flex justify-content-center">
                            <div>
                                <table style="font-size: x-small;">
                                    <tr>
                                        <td><span>Koordinat </span></td>
                                        <td>: </td>
                                        <td><span>${originData[1]}, ${originData[0]}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lokasi </td>
                                        <td>: </td>
                                        <td><span>${locationName}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Chart Traffic </td>
                                        <td>: </td>
                                        <td>
                                            <a href="javascript:void(0)" style="padding: 3px;" 
                                                data-traffic='${JSON.stringify(data)}'
                                                class="btn btn-sm btn-outline-success open-chart-traffic">
                                                <i class="fa-solid fa-traffic-light"></i> Open</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    `;
                    
                    let islngLatDestination = `${destinationData[1]}_${destinationData[0]}`;
                    addMarker(destinationData, `trafficFlowGoogleMarker_${islngLatDestination}`, 'Titik Penanda', popupContentDestination);


                    let responseJalanTraffic = await getData(`/traffic/current?origin=${data.latlng_start}&destination=${data.latlng_end}`);
                    if (responseJalanTraffic.status_code == 200) {
                        let jsonJalanTraffic = responseJalanTraffic.data;
                        let item = jsonJalanTraffic;

                        var lnglatData = [];
                        var leafletPolyline = L.Polyline.fromEncoded(item.routes[0].overview_polyline.points);
                        $.each(leafletPolyline._latlngs,function(index,item){
                            lnglatData.push([item.lng,item.lat]);
                        })

                        // Menentukan warna garis berdasarkan status lalu lintas
                        var trafficStatus = getTrafficLevel(item.routes[0].legs[0].duration_in_traffic.value, item.routes[0].legs[0].distance.value);
                        var lineColor = getLineColor(trafficStatus);
                        let isIdTrafficFlow = (item.routes[0].summary).replaceAll(' ','_');
                        let rand = (Math.random() + 1).toString(36).substring(7);
                        isIdTrafficFlow = `${isIdTrafficFlow}_${rand}`;
                      
                        map.addSource(isIdTrafficFlow, {
                          'type': 'geojson',
                          'data': {
                                'type': 'Feature',
                                'properties': {},
                                'geometry': {
                                    'type': 'LineString',
                                    'coordinates': lnglatData
                                }
                            }
                        });
                        
                        map.addLayer({
                          'id': `trafficFlowGoogle_${isIdTrafficFlow}`,
                          'type': 'line',
                          'source': isIdTrafficFlow,
                          'layout': {
                            'line-join': 'round',
                            'line-cap': 'round'
                          },
                          'paint': {
                            'line-color': lineColor,
                            'line-width': 4
                          }
                        });
                        

                    }
        
                });

            }
        });
    }

    function onClickKmlMap(id, title, data=false) {
        map.on('click', id, (e) => {
            const featureProperties = e.features[0].properties;
            let valueData = Object.entries(featureProperties);
            let popupContent = `
                    <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                        <span>${title}</span>
                        <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                            <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                        </div>
                    </div>
            `;
            popupContent += `<div class="ms-2 me-auto"> <div class="tableWrapper" style="flex-basis:80%;overflow-y:auto;display:flex;width:100%;"> <table class="table-small table-hover" style="width: 100%;">`;
            
            popupContent += `
                <tr>
                    <td>Unit Kerja</td>
                    <td>:</td>
                    <td>
                        ${data.work_unit_nama}
                    </td>
                </tr>
            `;
            
            for (let i = 0; i < valueData.length; i++) {
                const valData = valueData[i];
                popupContent += `
                    <tr>
                        <td>${valData[0]}</td>
                        <td>:</td>
                        <td>${valData[1]}</td>
                    </tr>
                `;
            }
            
            if (data.documents) {
                let listDokumen = ``;
                // for (let i = 0; i < data.documents.length; i++) {
                    // const element = data.documents[i];
                    const element = data.documents;
                    listDokumen += `<li><a href='${element}' target="_blank"><span class="badge text-bg-success">File Pdf ${i+1}</span></a></li>`;
                // }
                popupContent += `
                    <tr>
                        <td>Dokumen Pendukung</td>
                        <td>:</td>
                        <td>
                            <ol class="list-group list-group-numbered">
                            ${listDokumen}
                            </ol>
                        </td>
                    </tr>
                `;
            }
        
            
            popupContent += `</table> </div></div>`;
            
            new maptilersdk.Popup()
                .setLngLat(e.lngLat)
                .setHTML(popupContent)
                .addTo(map);
        });
        
        map.on('mouseenter', id, () => {
            map.getCanvas().style.cursor = 'pointer';
        });
        
        map.on('mouseleave', id, () => {
            map.getCanvas().style.cursor = '';
        });
    }

    // fasilitas jalan
    async function showFasilitasJalan() {
        // Menampilkan indikator sedang memuat
        $("#load-jalan").removeClass('d-none');
        $("#show-jalan").addClass('d-none');
        
        $("#load-terminal").removeClass('d-none');
        $("#show-terminal").addClass('d-none');

        $("#load-fasilitas").removeClass('d-none');
        $("#show-fasilitas").addClass('d-none');

        let responseFasJal = await getData("/public-facilities/list");
        if (responseFasJal.status_code == 200) {
            $("#load-jalan").addClass('d-none');
            $("#show-jalan").removeClass('d-none');

            $("#load-terminal").addClass('d-none');
            $("#show-terminal").removeClass('d-none');

            $("#load-fasilitas").addClass('d-none');
            $("#show-fasilitas").removeClass('d-none');

            let jsonDataFasJal = responseFasJal.data;
            let titleFasJal = "Fasilitas Jalan";
            let domHtmlFasJal = "";
            let domHtmlFasJalModal = "";
            domHtmlFasJalModal += `<ol class="list-group list-group-numbered">`;
            let facilityType = [];
            let facilityTotal = [];
            
            jsonDataFasJal.map(async (data, i) => {
                facilityType.push(data.facility_type_nama);
                domHtmlFasJal += domHtmlJalanRight(data);

                let isHtml = `<li class="card d-flex justify-content-between align-items-start fly-to-map mb-3" style="background: transparent;color: #05fcbc;border-color: #05fcbc; cursor: pointer;"
                                data-lat="${data.latitude}"
                                data-lng="${data.longitude}"
                                data-index="${i}"
                                data-name-marker="fasilitas">
                                <div class="card-header border-bottom border-success w-100">
                                    <div class="fw-bold w-100 text-center">${data.name}</div>
                                </div>
                                <div class="card-body ms-2 me-auto" style="overflow-y:scroll; max-height: 100%;">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td><i class="fa-solid fa-route me-2"></i></td>
                                            <td>Tipe</td>
                                            <td> : </td>
                                            <td>${data.facility_type_nama ? data.facility_type_nama : "Data Tipe Fasilitas belum ada"}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-location-dot me-2"></i></td>
                                            <td>Longitude</td>
                                            <td> : </td>
                                            <td>${data.longitude ? data.longitude : 'Data Longtitude belum ada'}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-location-dot me-2"></i></td>
                                            <td>Latitude</td>
                                            <td> : </td>
                                            <td>${data.latitude ? data.latitude : 'Data Latitude belum ada'}</td>
                                        </tr>
                                    </table>
                                </div>
                            </li>`;
                domHtmlFasJalModal += isHtml;

                let popupContentDoc = '';
                if (data.documents) {
                    let listDokumen = ``;
                    // for (let i = 0; i < data.documents.length; i++) {
                        // const element = data.documents[i];
                        const element = data.documents;
                        listDokumen += `<li><a href='${element}' target="_blank"><span class="badge text-bg-success">File Pdf ${i + 1}</span></a></li>`;
                    // }
                    popupContentDoc = `
                        <tr>
                            <td>Dokumen Pendukung</td>
                            <td>:</td>
                            <td>
                                <ol class="list-group list-group-numbered">
                                    ${listDokumen}
                                </ol>
                            </td>
                        </tr>`;
                }

                let popupContent = `
                    <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                        <span>${titleFasJal}</span>
                        <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                            <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                        </div>
                    </div>
                    <div class="ms-2 me-auto">
                        <div class="tableWrapper" style="flex-basis:80%;overflow-y:auto;display:flex;width:100%;"> 
                            <table class="table-small table-hover" style="width: 100%;">
                                <tr>
                                    <td colspan="3"><div class="fw-bold">${data.name}</div></td>
                                </tr>
                                <tr>
                                    <td>Unit Kerja</td>
                                    <td>:</td>
                                    <td>${data.work_unit_nama ? data.work_unit_nama : "-"}</td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td>:</td>
                                    <td>${data.facility_type_nama ? data.facility_type_nama : "-"}</td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td>:</td>
                                    <td>${data.longitude ? data.longitude : '-'}</td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td>:</td>
                                    <td>${data.latitude ? data.latitude : '-'}</td>
                                </tr>
                                ${popupContentDoc}
                            </table>
                        </div>
                    </div>`;
                let lngLatFasJal = [data.longitude, data.latitude];
                addMarker(lngLatFasJal, `fasilitas_${i}`, "", popupContent);
            });

            domHtmlFasJalModal += `</ol>`;
            facilityType = [...new Set(facilityType)];

            facilityType.map((dataFacTyp) => {
                let totalFacility = [];
                jsonDataFasJal.map(async (data) => {
                    if (dataFacTyp == data.facility_type_nama) {
                        totalFacility.push(1)
                    }
                });
                facilityTotal.push(sumArray(totalFacility));
            });

            $("#fasilitas-jalan-right").html(domHtmlFasJal);
            $("#fasilitas-jalan-detail-modal").html(domHtmlFasJalModal);

            // // chart fasilitas
            // let baseColor = "#00FFFF"; // Warna dasar Cyan
            // let numberOfColors = facilityType.length; // Jumlah warna dalam palet
            // let colorPalette = generateColorPalette(baseColor, numberOfColors);
            // var ctx = document.getElementById("fasilitasPayChart").getContext("2d");
            // var fasilitasPayChart = new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //         labels: facilityType,
            //         datasets: [{
            //             label: "Fasilitas",
            //             data: facilityTotal,
            //             backgroundColor: colorPalette,
            //             borderColor: colorPalette,
            //             borderWidth: 0.1,
            //         }],
            //     },
            //     options: {
            //         scales: {
            //             y: {
            //                 display: true,
            //                 beginAtZero: true,
            //                 ticks: {
            //                     color: "aquamarine",
            //                 },
            //             },
            //             x: {
            //                 ticks: {
            //                     color: "aquamarine",
            //                     font: {
            //                         size: 8,
            //                     },
            //                 },
            //             },
            //         },
            //         plugins: {
            //             legend: {
            //                 display: false
            //             },
            //         },
            //     }
            // });
        }
    }

    function domHtmlJalanRight(data) {
        let domHtml = `
                <div class="swiper-slide" style="height: 100px;">
                    <div class="card d-flex align-items-center h-100">
                        <table class="w-100 h-100 text-center">
                            <tr>
                                <td class="w-50"><i class="fa-solid fa-route me-2"></i> Nama</td>
                                <td class="w-50"><i class="fa-solid fa-building-columns me-2"></i> Tipe</td>
                            </tr>
                            <tr>
                                <td class="w-50">${data.name ? data.name : "-"}</td>
                                <td class="w-50">${data.facility_type && data.facility_type.name ? data.facility_type.name : "-"}</td>
                            </tr>
                        </table>
                    </div>
                </div>
        `;
        return domHtml;
    }


    // perlintasan kereta
    async function showPerlintasanKereta() {
        map.on('load', async function() {
            let responseKa = await getData("/ews/geojson");

            // let responseKa = await getData("/data-perlintasan-kai");
            let jsonDataKa = {};
            if (responseKa.status_code == 200) {
                jsonDataKa = responseKa.data;
                
                const imagePKAI = await map.loadImage(`${window.location.origin}/assets/hud/img/warning.png`);
                map.addImage('pinPKAI', imagePKAI.data);
                
                map.addSource('geoJsonPerlintasanKeretaApi', {
                    'type': 'geojson',
                    'data': jsonDataKa
                });
                
                map.addLayer({
                    'id': 'perlintasanKeretaApiLayer',
                    'type': 'symbol',
                    'source': 'geoJsonPerlintasanKeretaApi',
                    'layout': {
                        'icon-image': 'pinPKAI',
                        'icon-size': 0.5,
                        'text-field': ['get', 'name'],
                        'text-font': ['Open Sans Semibold', 'Arial Unicode MS Bold'],
                        'text-offset': [0, 1.25],
                        'text-anchor': 'top',
                        'text-size': 12,
                        'icon-allow-overlap': true
                    },
                    'paint': {
                        'text-color': '#FFFFFF'
                    }
                });
            }
            
            map.on('click', 'perlintasanKeretaApiLayer', (e) => {
                const featureProperties = e.features[0].properties;
                // let valueData = Object.entries(featureProperties.data);
                // const keyValuePairs = objectToKeyValuePairs(valueData);
                let valueData = featureProperties.data;
                valueData = JSON.parse(valueData);

                let popupContent = `
                    <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                        <span>Early Warning System</span>
                        <div>${featureProperties.category}</div>
                        <div>${featureProperties.title}</div>
                        <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                            <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                        </div>
                    </div>
                    <div class="ms-2 me-auto">
                `;
                popupContent += `<div class="tableWrapper" style="flex-basis:80%;overflow-y:auto;display:flex;width:100%;height: 15rem;"> <table class="table-small table-hover" style="width: 100%;">`;
                for (let i = 0; i < valueData.length; i++) {
                    const valData = valueData[i];
                    popupContent += `
                        <tr>
                            <td>${valData.key}</td>
                            <td>:</td>
                            <td>${valData.value}</td>
                        </tr>
                    `;
                }
                popupContent += `</table> </div></div>`;
                
                new maptilersdk.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(popupContent)
                    .addTo(map);
            });

            map.on('mouseenter', 'perlintasanKeretaApiLayer', () => {
                map.getCanvas().style.cursor = 'pointer';
            });

            map.on('mouseleave', 'perlintasanKeretaApiLayer', () => {
                map.getCanvas().style.cursor = '';
            });


            //traffic layer
            // map.addSource('trafficFlow', {
            //     type: 'raster',
            //     tiles: [
            //         `https://api.tomtom.com/traffic/map/4/tile/flow/relative0-dark/{z}/{x}/{y}.png?tileSize=256&key=${apiKeyTt}`
            //     ],
            //     tileSize: 256
            // });

            // trafficFlowLayer = map.addLayer({
            //     id: 'trafficFlow',
            //     type: 'raster',
            //     source: 'trafficFlow',
            //     layout: {
            //         visibility: 'visible'
            //     }
            // });

        });
        
        map.on('error', function(e) {
            console.error('An error occurred:', e.error.message);
        });
    }


    // get data
    async function getData(urlFragment = "/data-terminal", isApi = true, isMethod="GET") {
        let isUrl = isApi ? apiUrl + urlFragment : urlFragment;
        var settings = {
            "url": isUrl,
            "method": isMethod,
            "timeout": 0,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };

        return await $.ajax(settings);
    }
    // end get data

    async function getKmltoJson(paramsUrl) {
        const fetchXmlData = await $.ajax(`${paramsUrl}`).done(function (xml) {
            return (new DOMParser()).parseFromString(toGeoJSON.kml(xml), 'text/xml');
        });
        return convertXMLToGeoJSON(fetchXmlData);
    }

    function convertXMLToGeoJSON(xmlString) {
        const xmlDoc = xmlString;

        const features = [];
        const placemarks = xmlDoc.getElementsByTagName("Placemark");

        for (let i = 0; i < placemarks.length; i++) {
            const placemark = placemarks[i];

            const name = placemark.getElementsByTagName("name")[0]?.textContent || "";
            const description = placemark.getElementsByTagName("description")[0]?.textContent || "";

            const properties = {
                name: name,
                description: description
            };

            const geometryElement = placemark.getElementsByTagName("Point")[0] ||
                placemark.getElementsByTagName("LineString")[0];
            const property = placemark.getElementsByTagName("name");

            if (geometryElement) {
                const coordinates = parseCoordinates(geometryElement.textContent);
                const geometry = createGeometryObject(geometryElement.tagName, coordinates);

                features.push({
                    type: "Feature",
                    geometry: geometry,
                    properties: properties
                });
            }
        }

        const geoJSON = {
            type: "FeatureCollection",
            features: features
        };

        return geoJSON;
    }

    function parseCoordinates(coordString) {
        const coordinates = coordString.trim().split(/\s+/).map(coord => coord.split(',').map(parseFloat));
        return coordinates;
    }

    function createGeometryObject(geometryType, coordinates) {
        const geometry = {
            type: null,
            coordinates: null
        };

        switch (geometryType.toLowerCase()) {
            case "point":
                geometry.type = "Point";
                geometry.coordinates = coordinates[0];
                break;
            case "linestring":
                geometry.type = "LineString";
                geometry.coordinates = coordinates;
                break;
        }

        return geometry;
    }

    function isNotEmptyObject(obj) {
        for (const key in obj) {
            if (obj.hasOwnProperty(key)) {
                return true;
            }
        }
        return false;
    }    

    function isValidJSON(str) {
        try {
            JSON.parse(str);
            return true;
        } catch (e) {
            return false;
        }
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    
    function formatNumberToWithPoint(num) {
        return accounting.formatMoney(num, "", 0, "."); 
    }

    function formatNumberToIDR(nominal) {
        return accounting.formatMoney(nominal, "Rp ", 0, "."); 
    }

    const sumArray = arr => arr.reduce((sum, current) => sum + current, 0);

    // color function
    function getRandomColor(baseColor="#00FFFF") {
        // Konversi warna dasar dari hex ke RGB
        const baseRgb = hexToRgb(baseColor);
        const randomRgb = {
          r: (baseRgb.r + Math.floor(Math.random() * 256)) % 256,
          g: (baseRgb.g + Math.floor(Math.random() * 256)) % 256,
          b: (baseRgb.b + Math.floor(Math.random() * 256)) % 256
        };
        return rgbToHex(randomRgb);
    }
    
    function hexToRgb(hex) {
        // Konversi warna hex ke RGB
        const bigint = parseInt(hex.slice(1), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return { r, g, b };
    }
    
    function rgbToHex(rgb) {
        // Konversi warna RGB ke hex
        const { r, g, b } = rgb;
        return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1).toUpperCase()}`;
    }
    
    function generateColorPalette(baseColor="#00FFFF", numberOfColors) {
        const colorPalette = [];
        for (let i = 0; i < numberOfColors; i++) {
            colorPalette.push(getRandomColor(baseColor));
        }
        return colorPalette;
    }

    // Fungsi untuk mendapatkan koordinat pertama dan terakhir dari LineString
    function getFirstAndLastCoordinates(geojson) {
      const features = geojson;
    //   for (let i = 0; i < features.length; i++) {
    //     const feature = features[i];
        if (features.geometry.type === 'LineString') {
          const coordinates = features.geometry.coordinates;
          const firstCoordinate = coordinates[0];
          firstCoordinate.pop();
          const lastCoordinate = coordinates[coordinates.length - 1];
          lastCoordinate.pop();
          return { firstCoordinate, lastCoordinate };
        }
    //   }
      return null;
    }

    function getCurrentWeekDates() {
        const currentDate = moment();

        // Set Monday as the start of the week
        const startOfWeek = currentDate.clone().startOf('isoWeek');

        // Get the end of the week (Sunday)
        const endOfWeek = currentDate.clone().endOf('isoWeek');

        return {
            startOfWeek: startOfWeek.format('YYYY-MM-DD'),
            endOfWeek: endOfWeek.format('YYYY-MM-DD')
        };
    }

    // Function to convert object to key-value pairs
    function objectToKeyValuePairs(obj) {
        return Object.entries(obj).map(([key, value]) => {
            return { key, value };
        });
    }
</script>