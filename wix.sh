echo 'dios'
cd dominios
mkdir $1
cd $1
echo $2 | cat > index.php
mkdir css
cd css
mkdir user
echo '' | cat > user/estilo.css
mkdir admin
echo '' | cat > admin/estilo.css
cd ..
mkdir img
cd img
mkdir avatars
mkdir buttons
mkdir products
mkdir pets
cd ..
mkdir js
cd js
mkdir validations
echo '' | cat > validations/login.js
echo '' | cat > validations/register.js
mkdir effects
echo '' | cat > panels.js
cd ..
mkdir tpl
cd tpl
echo '' | cat > main.tpl
echo '' | cat > login.tpl
echo '' | cat > register.tpl
echo '' | cat > panel.tpl
echo '' | cat > profile.tpl
echo '' | cat > crud.tpl
cd ..
mkdir php
cd php
echo '' | cat > create.php
echo '' | cat > read.php
echo '' | cat > update.php
echo '' | cat > delete.php
echo '' | cat > dbconect.php

