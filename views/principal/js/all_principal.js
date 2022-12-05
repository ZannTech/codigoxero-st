(() => {
  $("#tablero").addClass("active");
})();
let chart;
let chart_pie;
var map;
let chart_graph_zones;
let chart_graph_zones_pie
let chart_msj;

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
  }
var chart_progress;
const _get_data_redes = () => {
  return $.ajax({
    type: "POST",
    url: URL + "principal/get_redes_report",
    dataType: "json",
    cache: false,
    async: !1,
  });
};
$(".selectdate").on("click", () => {
  $("#modal_filter").modal("show");
});
$(document).ready(function () {
  $("#ifecha").bootstrapMaterialDatePicker({
    date: true,
    format: "YYYY-MM-DD",
    lang: "es",
    weekStart: 1,
    cancelText: "Anular",
    nowText: "Hoy",
  });
  $("#ffecha").bootstrapMaterialDatePicker({
    date: true,
    format: "YYYY-MM-DD",
    lang: "es",
    weekStart: 1,
    cancelText: "Anular",
    nowText: "Hoy",
  });
});
$(document).ready(function () {
  list_data("-");
});
const list_data = (filter = "") => {
  let data = {
    ifecha: $("#ifecha").val(),
    ffecha: $("#ffecha").val(),
  };

  if (data.ifecha != "" && data.ffecha != "") {
    $("#fl_txt").html(data.ifecha + " - " + data.ffecha);
    let ux =
      filter == ""
        ? URL + "principal/new_dashboard/" + Math.random()
        : URL + "principal/new_dashboard/";
    $.ajax({
      type: "POST",
      url: ux,
      data: data,
      dataType: "json",
      success: function (response) {
        let data = response.data;
        console.log(data);
        $(".msj_sended").html(data.wsp_env.c);
        $(".sms_sended").html(data.sms_env.c);
        $(".coste").html(`US ` + ((parseInt(data.wsp_env.c) + parseInt(data.sms_env.c)) * 0.050).toFixed(2))
        $(".person_sended").html(data.persons_reg.c);
        $(".district_sended").html(data.district_reg.c);

        $(".zones_sended").html(data.zones_reg.c);
        $(".street_sended").html(data.streets_reg.c);
        var ctx = document.getElementById("report_redes").getContext("2d");
        var ctx1 = document.getElementById("report_redes_pie").getContext("2d");
        let data_redes = _get_data_redes();
        let json = data_redes.responseJSON;
        var data_progress = [];
        var catg_progress = [];
        const config_redes = {
          labels: [
            "Whatsapp",
            "Facebook",
            "Twitter",
            "Instagram",
            "Tiktok",
            "Twitch",
          ],
          datasets: [
            {
              label: "Redes sociales",
              data: [
                data.wsp.cantidad ,
                data.fb.cantidad  ,
                data.twitter.cantidad  ,
                data.ig.cantidad  ,
                data.tiktok.cantidad  ,
                data.twitch.cantidad  ,
              ],
              backgroundColor: [
                "rgba(17, 255, 72, 0.8)",
                "rgba(0, 72, 110, 0.8)",
                "rgba(10, 169, 248, 0.8)",
                "rgba(217, 89, 16, 0.8)",
                "rgba(50, 49, 50, 0.8)",
                "rgba(231, 0, 255, 0.8)",
              ],
            },
          ],
        };
        if (chart) {
          chart.destroy();
        }
        chart = new Chart(ctx, {
          // The type of chart we want to create
          type: "bar",
          // The data for our dataset
          data: config_redes,
        });

        if (chart_pie) {
          chart_pie.destroy();
        }
        chart_pie = new Chart(ctx1, {
          // The type of chart we want to create
          type: "pie",
          // The data for our dataset
          data: config_redes,
        });
        if (map) map.remove();
        map = L.map("map").setView([-12.068867, -77.03064], 10);
        var tiles = L.tileLayer(
          "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
          {
            maxZoom: 19,
            attribution:
              '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
          }
        ).addTo(map);

        let heathMapPoints = [];

        for (let x of data.persons) {
          if (x.latitude != null && x.longitude != null) {
            heathMapPoints.push([x.latitude, x.longitude, 2.3]);
            L.marker([x.latitude, x.longitude])
              .addTo(map)
              .bindPopup(
                `
                    <div class="row">
                        <div class="col-12">
                            <p>
                            <b>
                            ${
                              x.type_user.type +
                              " : " +
                              x.first_name +
                              " " +
                              x.last_name
                            }
                            <br>DISTRITO:${x.distrito.description}
                            <br>ZONA:    ${x.zona.description}
                            <br>MANZANA: ${x.manzana.description}
                            </b>
                            </p>
                        </div>
                    </div>
                `
              )
              .openPopup();
          }
        }
        var heat = L.heatLayer(heathMapPoints, {
          radius: 25,
          minOpacity: 0.6,
          gradient: {
            0: "Navy",
            0.25: "Navy",
            0.26: "Green",
            0.5: "Green",
            0.51: "Yellow",
            0.75: "Yellow",
            0.76: "Red",
            1: "Red",
          },
        }).addTo(map);

        $("#par_inf").empty();

        let c = 0;


        if (data.metas.length > 0) {
          for (let y of data.metas) {
            c += 1;
            console.log(y)
            if (y.asignacion != false) {
              console.log('aaa')
              catg_progress.push(y.detalle.description);
              data_progress.push(y.reporte.c );
              let pct = (parseInt(y.reporte.c) * 100) / y.cant_proposal;
              pct = pct >= 100 ? 100 : pct.toFixed(2);
              console.log(pct)
              $("#par_inf").append(
                `
                            <div class="card shadow-xl">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#col_${c}">INFORME DE PROGRESO DE  <b>${y.detalle.description.toUpperCase()}</b></a>
                            </div>
                            <div id="col_${c}" class="collapse" data-parent="#par_inf">
                                <div class="card-body">
                                    <div class="progress_area">
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:${pct}%">${pct}%</div>
                                        </div>
                                        <p>
                                            LA CUADRILLA DE TRABAJO DEL COORDINADOR ${(
                                              y.coordinador.first_name +
                                              " " +
                                              y.coordinador.last_name
                                            ).toUpperCase()} HA HECHO ${
                  y.reporte.c
                } REGISTROS DE ${y.cant_proposal} QUE TIENE COMO META
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `
              );
            }
          }
        } else {
          $("#par_inf").append(
            `
                        
                        `
          );
        }
        var catg_zonas = []
        var zonas_count = []
        for(let yx of data.zonas_graph){
            catg_zonas.push(yx.description)
            zonas_count.push(yx.count.c )
        }
        var options = {
          chart: {
            type: "line",
          },
          series: [
            {
              name: "Progreso de campo",
              data: data_progress,
            },
          ],
          xaxis: {
            categories: catg_progress,
          },
        };
        if(chart_progress){
            chart_progress.destroy();
        }
        chart_progress = new ApexCharts(document.querySelector("#chart_progress_campo_line"), options);
        chart_progress.render();
        var opts_zonas = {
            chart: {
                type: "line",
              },
              series: [
                {
                  name: "Personas Registradas",
                  data: zonas_count,
                },
              ],
              xaxis: {
                categories: catg_zonas,
              },
        }
        var opts_zonas_pie = {
            chart: {
                type: "area",
              },
              series: [
                {
                  name: "Personas Registradas",
                  data: zonas_count,
                },
              ],
              xaxis: {
                categories: catg_zonas,
              },
        }
        var opts_zonas_msj = {
          chart: {
              type: "area",
            },
            series: [
              {
                name: "Mensajería masiva",
                data: [data.wsp_env.c, data.sms_env.c],
              },
            ],
            xaxis: {
              categories: ['Whatsapp', 'SMS'],
            },
      }
        if(chart_graph_zones){
            chart_graph_zones.destroy();
        }
        if(chart_graph_zones_pie){
            chart_graph_zones_pie.destroy();
        }
        if (chart_msj) {
          chart_msj.destroy();
        }
        chart_msj = new ApexCharts(document.querySelector("#chart_progress_msj"),opts_zonas_msj);
        chart_graph_zones = new ApexCharts(document.querySelector("#chart_zona"), opts_zonas);
        chart_graph_zones_pie = new ApexCharts(document.querySelector("#chart_zona_pie"), opts_zonas_pie);
        chart_msj.render();
        chart_graph_zones_pie.render();
        chart_graph_zones.render();
      },
    });
  } else {
    toastr.error("Error, rellena todos los campos");
  }
};
$(".filter").on("click", () => {
  list_data("");
  $("#modal_filter").modal("hide");
});
const _get_weather = () => {
  $.ajax({
    type: "POST",
    url: URL + "principal/get_weather",
    dataType: "json",
    beforeSend: () => {
      $(".weather_container").prepend(
        `<img class="img-responsive center-block d-block mx-auto loader_card" src="${IMAGE_PATH}/loaders/loader_inf.gif">`
      );
    },
    success: function (response) {
      // Creamos array con los días de la semana
      const dias_semana = [
        "Domingo",
        "Lunes",
        "martes",
        "Miércoles",
        "Jueves",
        "Viernes",
        "Sábado",
      ];
      const fecha = new Date();
      const dia = dias_semana[fecha.getDay()];
      $(".weather_container").empty();
      let url = response.current.condition.icon;
      url = url.replace("64x64", "128x128");
      const temp = response.current.temp_c.toFixed(1) + " °C";
      const URL_API = `https://api.mymemory.translated.net/get?q=${response.current.condition.text}&langpair=en|es`;
      fetch(URL_API)
        .then((res) => res.json())
        .then((data) => {
          $(".weather_container").prepend(
            `
                <div class="row">
                <div class="col-lg-12 pb-4">
                <h1 class="lead text-center">${data.responseData.translatedText == 'Borrar' ? 'Despejado' : data.responseData.translatedText }</h3>
                </div>
                    <div class="col-lg-12 pb-4">
                    <img 
                    class="img-responsive center-block d-block mx-auto" style=" margin: 0 auto;"
                    src="${url}"
                    />
                    </div>
                    <div class="col-lg-12 pb-4">
                    <h1 class="lead text-center">${response.location.tz_id}</h1>
                    </div>
                    <div class="col-lg-6 pb-3">
                        <h5 class="lead text-center">${dia}</h5>
                    </div>
                    <div class="col-lg-6 pb-3">
                        <h1 class="text-center">${temp}</h1>
                    </div>
                  
                </div>
                `
          );
        });
    },
  });
};
$(function () {
  _get_weather();
});

