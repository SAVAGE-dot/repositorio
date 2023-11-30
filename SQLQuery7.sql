CREATE DATABASE minimarket
go

use master

use minimarket


---------------------------------TABLAS-------------------------------------------------
create table Categoria(
	Id int primary key identity (1,1),
	Nombre varchar (50),
	Estado int default 1
);

create table Producto(
	Id int primary key Identity (1,1),
	Nombre varchar (50),
	Estado int default 1,
	Precio decimal (10, 2),
	IdCategoria int
	CONSTRAINT FK_Producto_Categoria Foreign key (IdCategoria) references Categoria (Id)
);
---------------------------------------FIN-------------------------------------------------------

-----------------------------------------------------------------------------------------------------
SELECT P.Id as Id_Producto,P.Nombre AS Nombre_Producto ,C.Id as IdCategoria,C.Nombre AS Categoria,P.Precio,P.Estado
      FROM Producto as P
      INNER JOIN Categoria as C ON C.Id = P.IdCategoria;
-----------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------
insert into Producto(Nombre,Precio,Estado, IdCategoria) values ('Glacitas',10.4,1,1)


insert into Categoria (Nombre) values ('Galletas y snacks dulces')
insert into Categoria (Nombre) values ('Licores')
insert into Categoria (Nombre) values ('Bebidas')
insert into Categoria (Nombre) values ('Helados')
---------------------------------------------------------------------------------

-----------------------------------
delete from Producto where Id = 1
-----------------------------------

-----------------------------
select * from Categoria

select * from Producto
-----------------------------


update Producto set Nombre = ?, Precio = ?, IdCategoria = ? where Id=?