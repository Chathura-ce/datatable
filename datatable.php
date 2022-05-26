<?php require_once 'Database.php';
$database = new Database();
$con = $database->con;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            width: 80%;
            margin: auto;
        }
        /*table*/
        thead tr th {
            border: 1px solid #af9e9e;
            background: #71ebff;
        }

        tbody tr td {
            border: 1px solid rgb(0 0 0 / 2%);
        }

        div.dataTables_wrapper {
            width: 800px;
            margin: 0 auto;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
</head>
<body>
<div class="container">

    <div style="width: 100%;margin-bottom: 20px">
        <div style="display: inline-block">
            <label for="">name</label>
            <select id="name" onchange="filterData();">
                <option value="0">Select One</option>
                <?php
                $sql = "SELECT DISTINCT \n".
                    "	customers.customerName as name\n".
                    "FROM\n".
                    "	customers";
                $result_set = mysqli_query($con,$sql);
                while ($row = mysqli_fetch_assoc($result_set)){
                    echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                }
                ?>
            </select>
        </div>
        <div style="width: 20%;display: inline-block">
            <label for="">name</label>
            <select>
                <option value="0">Select One</option>
            </select>
        </div>
        <div style="width: 20%;display: inline-block">
            <label for="">name</label>
            <select>
                <option value="0">Select One</option>
            </select>
        </div>
        <div style="width: 20%;display: inline-block">
            <label for="">name</label>
            <select>
                <option value="0">Select One</option>
            </select>
        </div>
    </div>

    <div style="margin:auto;width: 200px;">
        <button onclick="addNewRow()">Add</button>
        <button onclick="filterData()">Load</button>
    </div>
    <table id="example" class="display nowrap cell-border" style="width:100%">
        <thead>
        <tr>
            <th>name</th>
            <th>phone</th>
            <th>city</th>
            <th>country</th>
            <th>show</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

<script>
    let table = null;
    $(document).ready(function () {
        let name = $('#name').val();
       table =  $('#example').DataTable({
           ajax: {
               "url":'datatableAjax.php',
               "type": 'POST',
               "data": function ( d ) {
                   d.name = $('#name').val();
               }
           },
           columns: [
               { data: 'name' },
               { data: 'phone' },
               { data: 'city' },
               { data: 'country' },
               null
           ],
           columnDefs: [
               {
                   targets: 4,
                   data: null,
                   defaultContent: '<button>Click!1</button>',
                   sortable: false,
                   searchable: false,
               }
           ],
            paging: false,
            scrollY: 200,
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Anything"
            }
        });
    });

    function filterData() {
        table.ajax.reload();
    }

   /* $(document).ready(function () {
       let table =  $('#example').DataTable({
            paging: false,
            scrollY: 200,
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Anything"
            }
        });
    });*/
</script>