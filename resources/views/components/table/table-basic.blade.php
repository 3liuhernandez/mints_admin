
<div class="container-fluid py-5 my-5">

    <div class="container-fluid">
        <div style="overflow-x:auto;">
            <table class="table table-hover" id="{{$name}}">
                <thead>
                    <tr>
                        @foreach ($heading as $row)
                            <th>{{ $row['label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            @foreach($row as $key => $item)
                                <td class="col-{{$key}}">{{$item}}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        @foreach ($heading as $row)
                            <th>{{ $row['label'] }}</th>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<script>
    jQuery( () => {
        const t = new DataTable('<?php echo $name;?>');
        t.init();
    });
</script>