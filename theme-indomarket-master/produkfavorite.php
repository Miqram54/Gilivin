<!DOCTYPE html>
<html lang="en" ng-app="myApp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Favorite</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #A5B68D;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            margin-top: 50px;
        }

        .crud-table {
            background-color: #A0D683;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .crud-table .btn {
            margin-bottom: 10px;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
        }

        .form-inline {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-warning i,
        .btn-danger i {
            margin-right: 5px;
        }

        .btn-warning {
            background-color: #FFE6A5;
            border-color: #C4DAD2;
        }

        .table-striped {
            font-family: "Space Grotesk", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }
    </style>
</head>

<body ng-controller="namesCtrl">

    <div class="container wrapper">
        <div class="crud-table">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-success" ng-click="addUser()">
                    <i class="bi bi-plus-circle-fill"></i> Produk Favorite
                </button>
                <div class="form-inline">
                    <label for="searchName" class="form-label me-2">Search by name:</label>
                    <input type="text" id="searchName" ng-model="searchName" placeholder="Type name to search" class="form-control">
                </div>
            </div>

            <table class="table table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Created_at</th>
                        <th>Tambah keranjang</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in wishlist2 | filter:searchName">
                        <td>{{$index + 1}}</td>
                        <td>{{item.product_name}}</td>
                        <td>Rp. {{item.product_price}}</td>
                        <td>{{item.created_at}}</td>
                        <td>
                            <button class="btn btn-warning" ng-click="addToCart(item)">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger" ng-click="deleteItem(item)">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and AngularJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script>
        var app = angular.module('myApp', []);
        app.controller('namesCtrl', function ($scope, $http, $window) {
            // Fetch data from wishlist2.php
            $http.get('wishlist_handler2.php')
                .then(function (response) {
                    $scope.wishlist2 = response.data;
                }, function (error) {
                    console.log('Error loading wishlist2:', error);
                });

            // Function to add item to cart
            $scope.addToCart = function (item) {
                var product = {
                    id: item.id,
                    product_name: item.product_name,
                    price: item.product_price,
                    created_at: new Date()
                };

                // Post the data to backend API
                $http.post('/api/addToCart', product)
                    .then(function (response) {
                        if (response.data.success) {
                            // Redirect to cart page if successful
                            $window.location.href = "/cart";
                        } else {
                            console.log('Error adding to cart: ', response.data.message);
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
            };

            // Function to delete item
            $scope.deleteItem = function (item) {
                var id = item.id;
                // Call API to delete item
                $http.post('wishlist_handler2.php', { id: id, action: 'delete' })
                    .then(function (response) {
                        if (response.data.success) {
                            // Refresh the list by removing the deleted item
                            $scope.wishlist2 = $scope.wishlist2.filter(i => i.id !== id);
                        } else {
                            console.log('Error deleting item: ', response.data.message);
                        }
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
            };
        });
    </script>

</body>

</html>
