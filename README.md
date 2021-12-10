## Utilizar o Projeto
Abra Terminal. \
Crie um clone bare do repositório.\
``$ git clone --bare https://github.com/yurirene/projeto-base-laravel.git`` \
Faça espelhamento/push no novo repositório. \
``$ cd old-repository`` \
``$ git push --mirror https://github.com/yurirene/NOVO-PROJETO.git`` \
Remova o repositório local temporário que você criou anteriormente. \
``$ cd ..`` \
``$ rm -rf old-repository`` \
