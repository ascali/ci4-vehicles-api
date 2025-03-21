<script>
    // animate map
    function rotateMap() {
        if (!isMouseMoving) {
            rotationAngle += 1;
            map.rotateTo(rotationAngle, {
                duration: 300,
                easing: function(t) { return t; }
            });
        }
    }

    // rotateInterval = setInterval(rotateMap, 200);

    map.on('mousemove', function() {
        clearTimeout(mouseMoveTimeout);

        isMouseMoving = true;

        mouseMoveTimeout = setTimeout(function() {
            isMouseMoving = false;
        }, 1000);
    });

    map.on('mouseleave', function() {
        isMouseMoving = false;
    });

    function drawRouteFromClick() {
        if (map.getLayer(routeLayerId)) {
            map.removeLayer(routeLayerId);
            map.removeSource(routeLayerId);
        }

        if (points.length < 2) return;

        const route = {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'geometry': {
                    'type': 'LineString',
                    'coordinates': points.map(p => [p.lng, p.lat])
                }
            }]
        };

        map.addSource(routeLayerId, {
            'type': 'geojson',
            'data': route
        });

        map.addLayer({
            'id': routeLayerId,
            'type': 'line',
            'source': routeLayerId,
            'layout': {
                'line-cap': 'round',
                'line-join': 'round'
            },
            'paint': {
                'line-color': 'aquamarine',
                'line-width': 4
            }
        });
    }

    const contextMenu = document.getElementById('context-menu');

    map.on('contextmenu', function(e) {
        e.preventDefault();
        clickLngLat = e.lngLat;
        contextMenu.style.top = `${e.point.y}px`;
        contextMenu.style.left = `${e.point.x}px`;
        contextMenu.style.display = 'block';
    });

    map.on('click', function() {
        contextMenu.style.display = 'none';
    });

    document.getElementById('create-route').addEventListener('click', function() {
        points.push(clickLngLat);
        contextMenu.style.display = 'none';
        addRouteMarker(clickLngLat);
        savePoint({
            lngLat: clickLngLat,
            type: 'route'
        });
        drawRouteFromClick();
    });

    let isLngLatTrafficGoogle = [];
    document.getElementById('add-marker').addEventListener('click', function() {
        contextMenu.style.display = 'none';
        addMarkerWithDetails(clickLngLat);
    });

    document.getElementById('delete-point').addEventListener('click', function() {
        contextMenu.style.display = 'none';
        // addMarkerWithDetails(clickLngLat);
    });

    // document.getElementById('add-cctv').addEventListener('click', function() {
    //     contextMenu.style.display = 'none';
    //     addCCTVMarker(clickLngLat);
    //     savePoint({
    //         lngLat: clickLngLat,
    //         title: 'CCTV'
    //     });
    // });

    function addMarker(lngLat, id="", title="", popupContent) {
        
        let elMarkerRoad = document.createElement('div');
        elMarkerRoad.className = 'marker';
        elMarkerRoad.style.backgroundImage = `url(${window.location.origin}/assets/hud/img/icon-road.png)`;
        elMarkerRoad.style.backgroundSize = '32px 32px';
        elMarkerRoad.style.width = '32px';
        elMarkerRoad.style.height = '32px';
        elMarkerRoad.style.top = '-1rem';

        markers[id] = new maptilersdk.Marker({ element: elMarkerRoad })
            .setLngLat(lngLat)
            .setPopup(new maptilersdk.Popup().setHTML(popupContent || `<span class="w-100 text-center">${title}</span>`))
            .addTo(map);
        let idMarker = id.split('_');
        theMarkers[idMarker[0]].push(markers[id]);
    }

    function addRouteMarker(lngLat) {
        const popupContent = `
        <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
            <span>Titik Jalur</span>
            <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
            </div>
            </div>
            <div class="w-100 text-center">
                <p>Koordinat: ${lngLat.lat.toFixed(6)}, ${lngLat.lng.toFixed(6)}</p>
            </div>
        `;
        let islngLat = `${lngLat.lat.toFixed(6)}_${lngLat.lng.toFixed(6)}`;
        addMarker(lngLat, `fromAddRouteMarker_${islngLat}`, 'Titik Jalur', popupContent);
    }

    async function addMarkerWithDetails(lngLat) {

        const apiKey = apicuaca;
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lngLat.lat}&lon=${lngLat.lng}&appid=${apiKey}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(async (data) => {
                const weather = data.weather[0].description;
                const locationName = data.name || 'Tidak Diketahui';

                const popupContent = `
                    <div class="popup-bus text-center mb-2" style="animation: back-animation 2s infinite;">
                        <span>Detail Titik</span>
                        <div style="height: 1.5rem;" data-bs-toggle="modal" data-bs-target="#bencanaModal">
                            <img style="width: 100%; height: 1rem;" src="${window.location.origin}/assets/hud/img/dashboard/popup-bar.png" alt="" />
                        </div>
                    </div>
                    <div class="fs-6 w-100 d-flex justify-content-center">
                        <div>
                            <table style="font-size: x-small;">
                                <tr>
                                    <td><span>Koordinat </span></td>
                                    <td>: </td>
                                    <td><span>${lngLat.lat.toFixed(6)}, ${lngLat.lng.toFixed(6)}</span></td>
                                </tr>
                                <tr>
                                    <td>Nama Lokasi </td>
                                    <td>: </td>
                                    <td><span>${locationName}</span></td>
                                </tr>
                                <tr>
                                    <td>Cuaca</td>
                                    <td>: </td>
                                    <td><span>${weather}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                `;
                
                let islngLat = `${lngLat.lat.toFixed(6)}_${lngLat.lng.toFixed(6)}`;
                isLngLatTrafficGoogle.push(islngLat);
                addMarker(lngLat, `trafficFlowGoogleMarker_${islngLat}`, 'Titik Penanda', popupContent);
                // savePoint({
                //     lngLat,
                //     title: locationName,
                //     weather
                // });

                if (isLngLatTrafficGoogle.length == 2) {

                    let origin = isLngLatTrafficGoogle[0].replaceAll('_', ',');
                    let destination = isLngLatTrafficGoogle[1].replaceAll('_', ',');
                    await getData(`/traffic/add?origin=${origin}&destination=${destination}&road_name=${locationName}`, true, "POST");
                    let responseJalanTraffic = await getData(`/traffic/current?origin=${origin}&destination=${destination}`);
            
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

                    isLngLatTrafficGoogle = [];
                }
                

            })
            .catch(error => {
                console.error('Error fetching weather data:', error);
            });
    }

    function addCCTVMarker(lngLat) {
        const apiKey = apicuaca;
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lngLat.lat}&lon=${lngLat.lng}&appid=${apiKey}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const locationName = data.name || 'Tidak Diketahui';

                const popupContent = `
                <div class="w-100 text-center">
                    <strong>CCTV Daerah : <p>${locationName}</p></strong>
                    <video controls class="w-100">
                        <source src="URL_VIDEO_CCTV" type="video/mp4">
                        Browser anda tidak mendukung tag video!.
                    </video>
                </div>
            `;

                new maptilersdk.Marker({
                        color: 'red'
                    })
                    .setLngLat(lngLat)
                    .setPopup(new maptilersdk.Popup().setHTML(popupContent))
                    .addTo(map);

                savePoint({
                    lngLat,
                    title: 'CCTV',
                    locationName
                });
            })
            .catch(error => {
                console.error('Error fetching location name:', error);
            });
    }

    function drawRouteFromClick() {
        const routeLayerId = 'route';

        if (map.getLayer(routeLayerId)) {
            map.removeLayer(routeLayerId);
            map.removeSource(routeLayerId);
        }

        if (points.length < 2) return;

        const route = {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'geometry': {
                    'type': 'LineString',
                    'coordinates': points.map(p => [p.lng, p.lat])
                }
            }]
        };

        map.addSource(routeLayerId, {
            'type': 'geojson',
            'data': route
        });

        map.addLayer({
            'id': routeLayerId,
            'type': 'line',
            'source': routeLayerId,
            'layout': {
                'line-cap': 'round',
                'line-join': 'round'
            },
            'paint': {
                'line-color': 'aquamarine',
                'line-width': 4
            }
        });
    }

    function savePoints() {
        localStorage.setItem('points', JSON.stringify(points));
    }

    function savePoint(point) {
        const savedPoints = JSON.parse(localStorage.getItem('points')) || [];
        savedPoints.push(point);
        localStorage.setItem('points', JSON.stringify(savedPoints));
    }

    function loadPoints() {
        const savedPoints = JSON.parse(localStorage.getItem('points')) || [];
        savedPoints.forEach(point => {
            if (point.title === 'CCTV') {
                addCCTVMarker(point.lngLat);
            } else if (point.type === 'route') {
                points.push(point.lngLat);
                addRouteMarker(point.lngLat);
            } else {
                addMarkerWithDetails(point.lngLat);
            }
        });
        drawRouteFromClick();
    }

    // Fungsi untuk mendapatkan tingkat kemacetan berdasarkan duration_in_traffic dan distance
    function getTrafficLevel(durationInTraffic, distance) {
        // Menghitung kecepatan rata-rata (m/s)
        var averageSpeed = distance / durationInTraffic;

        // Menggunakan nilai kecepatan tertentu untuk menentukan tingkat kemacetan
        if (averageSpeed < 2.5) { // Kurang dari 2.5 m/s (sekitar 9 km/jam)
            return "heavy";
        } else if (averageSpeed < 5) { // Kurang dari 5 m/s (sekitar 18 km/jam)
            return "moderate";
        } else {
            return "normal";
        }
    }

    // Fungsi untuk mendapatkan warna garis berdasarkan tingkat kemacetan
    function getLineColor(trafficLevel) {
        switch (trafficLevel) {
            case "heavy":
            return "red";
            case "moderate":
            return "orange";
            default:
            return "green";
        }
    }

        map.on('load', async function() {
            loadPoints();
        });
</script>