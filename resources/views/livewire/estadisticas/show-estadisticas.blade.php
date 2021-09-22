<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-jet-label value="Ventas" class="text-3xl font-bold" id="lab" />

        <div class="text-center">
            <p class="text-3xl pt-8 font-semibold" id="ventah">${{ $ventasHoy }}</p>
            <p class="text-xl">Ventas del día</p>
            <p class="text-3xl pt-8 font-semibold">${{ $ventasMes }}</p>
            <p class="text-xl pb-3">Ventas del mes</p>
        </div>

        
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-jet-label value="Productos"  class="text-3xl font-bold"/>
        <canvas id="myChart" width="640" height="100"></canvas>
    </div>





    <script type="text/javascript">
        const user = @json($productoMasVendido);
        const myObj = JSON.parse(user);
        var lb = myObj[0];
        var datpro = myObj[1];
        var nomPro = [];

        myObj[1].forEach(item => {
            nomPro.push(item[0])
        });

        console.log(nomPro);
        var resultlb = [];

        myObj.forEach(element => {
            resultlb.push(element);
        });
        // console.log(resultlb[1]);


        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nomPro,
                datasets: [{
                    label: 'Productos más vendidos',
                    data: resultlb[0],
                    backgroundColor: [
                        'rgba(22, 160, 133,0.2)'

                    ],
                    borderColor: [
                        'rgba(22, 160, 133,1.0)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>





</div>
