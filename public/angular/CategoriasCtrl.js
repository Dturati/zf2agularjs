categorias.
controller('CategoriasCtrl',
    ['$scope','CategoriasSrv','$location','$routeParams',
        function ($scope,CategoriasSrv,$location,$routeParams)
            {
                $scope.nome = "José";
                $scope.load = function () {
                    $scope.registros = CategoriasSrv.query();
                }

                $scope.get = function ()
                {
                    $scope.item = CategoriasSrv.get({id: $routeParams.id});
                }

                $scope.add = function($item)
                {
                    $scope.result = CategoriasSrv.save(
                        {},
                        $item,
                        function (data,status,headers,config) {
                            $location.path('/categorias/');
                        },
                        function (data,status,headers,config) {
                            alert("Erro ao inserir"+data.message[0]);
                        }
                    )
                }

                $scope.editar = function($item)
                {
                    $scope.result = CategoriasSrv.update(
                        {id: $routeParams.id},
                        $item,
                        function (data,status,headers,config) {
                            $location.path('/categorias/');
                        },
                        function (data,status,headers,config) {
                            alert("Erro ao inserir"+data.message[0]);
                        }
                    )
                }
            }]
);
