/**
 * require jquery
 * require datatables
 */
class DataTable {
    constructor(table_id) {
        this.table_id = table_id;
        this.table = $(`#${table_id}`);
        this.dt;

        this.options = {
            responsive: true,
            scrollx: true,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title:'Report',
                    text:'Reporte Excel',
                    exportOptions: {
                        format: {
                            body: function (data, rowIdx, colIndex, cellNode) {
                                // if ( $(cellNode).hasClass('col-categories') ) return $(cellNode).text().toString()
                                // if ( $(cellNode).hasClass('col-path_src') )   return $(cellNode).find('a').attr('href');
                                return $(cellNode).text()
                            }
                        }
                    },
                },
            ],
            oLanguage: {
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
        };
    }

    init () {
        this.dt = this.table.DataTable(this.options);
        this.dt.buttons().container().appendTo( `#${this.table_id}_wrapper .col-md-6:eq(0)`);
    }

    search(value) {
        this.table.search(value).draw();
    }

    filter(column, value) {
        this.table.column(column).search(value).draw();
    }

    sort(column, order) {
        this.table.order([column, order]).draw();
    }

    get_data() {
        return this.table.data().toArray();
    }
}