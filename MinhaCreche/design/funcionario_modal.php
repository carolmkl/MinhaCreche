<script src="js/angular.min.js"></script>
<script src="js/angular-route.js"></script>
<script src="js/app.js"></script>


<div class="conteiner">
                <form action="" autocomplete="on" method="post" 
                ng-app="minhaCrecheApp" 
                ng-controller="funcionarioCtrl" 
                ng-init = "id_funcionario = '<?php echo $f; ?>';getFuncionario('<?php echo $f; ?>')"
                ng-submit="salvaFuncionario()" >
                    <h1 ng-hide="$scope.id_funcionario" class="space">Adicionar Funcionário</h1>
                    <h1 ng-show="$scope.id_funcionario" class="space">Editar Funcionário</h1>
                    <div class="space">

                        <fieldset class="fieldset_border">
                            <legend>Acesso ao Sistema</legend>
                            <label class="text" for="name">Login</label>
                            <input class="width" type="text" value="" size="20" ng-model="login" required><br>
                            <label class="text" for="name">Senha</label>
                            <input class="width" type="password" value="" size="20" ng-model="senha" required><br>
                        </fieldset><br><br>

                        <fieldset class="fieldset_border">
                            <legend>Dados Pessoais</legend>
                            <label class="text" for="name">Nome</label>
                            <input class="text_big" type="text" ng-model="nome"> 
                            <label class="text" for="rg">RG</label>
                            <input class="text_small" type="text" ng-model="rg" >
                            <label class="text" for="cpf">CPF</label>
                            <input class="text_small" type="text" ng-model="cpf" ><br>
                            <label class="text" for="mail">E-mail</label>
                            <input class="text_bigger" type="email" ng-model="email" ><br>
                            <label class="text" for="telefone">Telefone</label>
                            <input type="tel" ng-model="telefone" >
                            <label class="text" for="celular">celular</label>
                            <input type="tel" ng-model="celular" ><br>
                            <label class="text" for="nascimento">Data de Nascimento</label>
                            <input type="date" ng-model="dtNascimento" >
                            <label class="text" for="celular">Gênero</label>
                            <select placeholder="Selecione" class="dropdown" for="genero" ng-model="genero" >
                                    <option value="">Selecione</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                            </select>
                        </fieldset>

                        <br>
                        <br>

                        <fieldset class="fieldset_border">
                            <legend>Endereço</legend>
                            <label class="text" for="logradouro">Logradouro</label>
                            <input class="text_bigger" type="text" ng-model="logradouro" > 
                            <label class="text" for="num">Numero</label>
                            <input class="text_small" type="number" ng-model="numero" ><br>
                            <label class="text" for="bairro">Bairro</label>
                            <input class="text_big" type="text" ng-model="bairro" > 
                            <label class="text" for="city">Cidade</label>
                            <input type="text" ng-model="cidade" >
                            <label class="text" for="state">Estado</label>
                            <input class="text_smaller" type="text" ng-model="estado" ><br>
                            <label class="text" for="obs">Observação</label> 
                            <input class="text_bigger" type="text" ng-model="observacao" ><br>
                        </fieldset>

                        <br>
                        <br>
                        <label class="text" for="cargo">Perfil</label>
                        <select class="dropdown" for="cargo" ng-model="cargo" >
                                <option value="">Selecione</option>
                                <option value="Diretor">Diretor</option>
                                <option value="Secretário">Secretário</option>
                                <option value="Professor">Professor</option>
                        </select>

                        <br>
                        <br>

                        <p> 
                            <input id="bsubmit" type="button" value="Confirmar" />
                            <input type="button" value="Cancelar" onclick="goBack()">
                        </p>
                    </div>
                </form>
            </div>
            