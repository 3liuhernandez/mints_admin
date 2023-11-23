@php
    $faker = Faker\Factory::create('es_VE');
    $members = [];
    for ($i=0; $i < 50; $i++) {

        $members[] = (object) [
            'id' => $i+1,
            'name' => $faker->name(),
            'last_name' => $faker->lastName(),
            'dni' => $faker->nationalId(),
            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->unique()->phoneNumber(),
            'f_bautizmo' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'status' => $faker->randomElement([1, 2, 3])
        ];
    }
@endphp


<div class="container-fluid py-5 my-5">

    <!-- CONTAINER SECCION PAGE -->
    <div class="container-fluid">
        <div class="" style="overflow-x:auto;">
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELEFONO</th>
                        <th>F. BAUTIZMO</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td class="col-id"> <?= $member->id; ?> </td>
                            <td class="col-id"> <?= $member->dni; ?> </td>
                            <td class="col-id"> <?= $member->name; ?> </td>
                            <td class="col-id"> <?= $member->last_name; ?> </td>
                            <td class="col-id"> <?= $member->phone; ?> </td>
                            <td class="col-id"> <?= $member->f_bautizmo; ?> </td>
                            <td class="col-id"> <?= $member->status; ?> </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>TELEFONO</th>
                        <th>F. BAUTIZMO</th>
                        <th>STATUS</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>


<style>
    #table_wrapper #table_length {
        margin-bottom: 1rem;
    }
</style>

<script>
    $(document).ready( function() {

        const $table = $('#table').DataTable({
            buttons: [
                {
                    extend: 'excelHtml5',
                    title:'Natura Comunica - Reporte de Placas',
                    text:'Reporte Excel',
                    exportOptions: {
                        format: {
                            body: function (data, rowIdx, colIndex, cellNode) {
                                if ( $(cellNode).hasClass('col-categories') ) {
                                    return $(cellNode).text().toString()
                                }

                                if ( $(cellNode).hasClass('col-path_src') ) {
                                    return $(cellNode).find('a').attr('href');
                                }

                                return $(cellNode).text()
                            }
                        }
                    },
                },
            ],
            responsive: true,
            scrollx: true,
            "oLanguage": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "sSearch": "Filtrar por:",

                "sLengthMenu": "Mostrar _MENU_ registros",

                "oPaginate": {
                    "sPrevious": "<i class='bi bi-caret-left-fill'> </i>",
                    "sNext": "<i class='bi bi-caret-right-fill'> </i>"
                },
            }
        });

        $table.buttons().container()
            .appendTo( '#table_wrapper .col-md-6:eq(0)' );
    })
</script>
