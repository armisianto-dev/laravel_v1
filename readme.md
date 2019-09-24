# laravel_v1
 
Konfigurasi Base :
- ViewComposer : dibagi sesuai template yang dipakai;
- Role Base (:OperatorBase, DeveloperBase, dll) : dibagi sesuai portal;
- MiddleWare : (:VerifyDeveloper, VerifyOperator, dll) : dibagi sesuai portal;
- Controller >> Auth : dibagi berdasarkan role, bisa dilepas rolenya (dibagi sesuai portal) asal satu user hanya bisa punya 1 role ;
