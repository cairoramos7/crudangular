<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>

    <!-- Material Design Style Sheets -->
    <link rel="stylesheet" href="libs/css/materialize.css">

    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <style type="text/css">
        .width-30-pct{
            width: 30%;
        }

        .margin-bottom-1em{
            margin-bottom: 1em;
        }
    </style>
</head>
<body>


    <div id="modal-product-form" class="modal">
    <div class="modal-content">
        <h4 id="modal-product-title">Create New Product</h4>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" ng-model="name" class="validate" id="form-name" placeholder="Type name here...">
                <label for="name">Name</label>
            </div>
            <div class="input-field col s12">
                <textarea class="validate materialize-textarea" id="" cols="30" rows="10" ng-model="description" placeholder="Type description here..."></textarea>
                <label for="description">Description</label>
            </div>
            <div class="input-field col s12">
                <input type="text" ng-model="price" class="validate" id="form-price" placeholder="Type price here...">
                <label for="price">Price</label>
            </div>
            <div class="input-field col s12">
                <a id="btn-create-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="createProduct()">
                    <i class="material-icons left">add</i> Add
                </a>
                <a id="btn-update-product" class="waves-effect waves-light btn margin-bottom-1em" ng-click="updateProduct()">
                    <i class="material-icons left">edit</i> Edit
                </a>
                <a class="modal-action modal-close waves-effect waves-light btn margin-bottom-1em">
                    <i class="material-icons left">close</i> Close
                </a>
            </div>
        </div>
    </div>
</div>

    <div class="container" ng-app="myApp" ng-controller="productsCtrl">
        <div class="row">
            <div class="col s12">
                <h4>Products</h4>
                <!-- used for searching the current list -->
                <input type="text" ng-model="search" class="form-control" placeholder="Search product..." />

                <!-- table that shows product record list -->
                <table class="hoverable bordered">

                    <thead>
                    <tr>
                        <th class="text-align-center">ID</th>
                        <th class="width-30-pct">Name</th>
                        <th class="width-30-pct">Description</th>
                        <th class="text-align-center">Price</th>
                        <th class="text-align-center">Action</th>
                    </tr>
                    </thead>

                    <tbody ng-init="getAll()">
                    <tr ng-repeat="d in names | filter:search">
                        <td class="text-align-center">{{ d.id }}</td>
                        <td>{{ d.name }}</td>
                        <td>{{ d.description }}</td>
                        <td class="text-align-center">{{ d.price }}</td>
                        <td>
                            <a ng-click="readOne(d.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">edit</i>Edit</a>
                            <a ng-click="deleteProduct(d.id)" class="waves-effect waves-light btn margin-bottom-1em"><i class="material-icons left">delete</i>Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="fixed-action-btn">
            <a class="waves-effect waves-light btn-floating btn-large waves-effect waves-light red" href="#modal-product-form" ng-click="showCreateForm()"><i class="material-icons">add</i></a>
        </div>

    </div>

<!-- Jquery -->
<script type="text/javascript" src="libs/js/jquery.min.js"></script>

<!-- Materiallize -->
<script type="text/javascript" src="libs/js/materiallize.js"></script>

<!-- AngularJs -->
<script type="text/javascript" src="libs/js/angular.min.js"></script>

<script>
    var app = angular.module('myApp', []);
    app.controller('productsCtrl', function($scope, $http)
    {
        /* AngularJs codes will be here */
        $scope.showCreateForm = function(){
            // clear form
            $scope.clearForm();

            // change modal title
            $('#modal-product-title').text("Create New Product");

            // hide update product button
            $('#btn-update-product').hide();

            // show create product button
            $('#btn-create-product').show();
        }

        /* Clear variable / form values */
        $scope.clearForm = function(){
            $scope.id = "";
            $scope.name = "";
            $scope.description = "";
            $scope.price = "";
        }

        $scope.createProduct = function(){
            // Fiels in key-value pairs
            $http.post('create_product.php',{
                'name' : $scope.name,
                'description' : $scope.description,
                'price' : $scope.price
            })
                .success(function(data, status, headers, config){
                    console.log(data);

                    // Tell the user new product was created
                    Materialize.toast(data, 4000);

                    // Close Modal
                    $('#modal-product-form').closeModal();

                    // Clear modal content
                    $scope.clearForm();

                    // Refresh the list
                    $scope.getAll();
                });
        }
        // Read products
        $scope.getAll = function(){
            $http.get("read_products.php").success(function(response){
                $scope.names = response.records;
            });
        }

        // retrieve record to fill out the form
        $scope.readOne = function(id){

            // change modal title
            $('#modal-product-title').text("Edit Product");

            // show udpate product button
            $('#btn-update-product').show();

            // show create product button
            $('#btn-create-product').hide();

            // post id of product to be edited
            $http.post('read_one.php', {
                'id' : id
            })
                .success(function(data, status, headers, config){

                    // put the values in form
                    $scope.id = data[0]["id"];
                    $scope.name = data[0]["name"];
                    $scope.description = data[0]["description"];
                    $scope.price = data[0]["price"];

                    // show modal
                    $('#modal-product-form').modal();
                })
                .error(function(data, status, headers, config){
                    Materialize.toast('Unable to retrieve record.', 4000);
                });
        }
    });
    $(document).ready(function(){
        // Initialize Modal
        $('#modal-product-form').modal();
    });
</script>
</body>
</html>