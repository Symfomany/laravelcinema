## MongoDB PHP Project

**Adaptation** of jenssegers/laravel-mongodb **for PHP7 and MongoDB Driver support**
*https://github.com/jenssegers/laravel-mongodb*

## Specs

* Bridge for Eloquant ORM & Query Builder to Laravel 5

## Requirements

* Illuminate Query Builder on Laravel 5
* Eloquent ORM
* mongodb/mongodb


## Goals & Evolution

 Explore API MongoDB to extends native features:

+ Database info
+ Bulk
+ DeleteMany
+ Delete
+ FindAndModify
+ FindAndDelete
+ InsertMany
+ Agregate: create command & execute
+ DeleteResult / InsertManyResult /InsertOneResult / UpdateResult  



Adapter
=======

First Part: MongoDB
-------------------

Connection (options)
+ collection() table()
+ getCollection()
+ getSchemaBuilder() 
+ getMongoClient() => Cient
+ getMongoDB() => db
+ createConnection() / getDriverName()
+ getDsn()
+ disconnect()

Collection ( Connection/ Collection Mongo DRiver
+ __call() => faire appel au methode natives du Driver + Gestion des logs

Builder (connection + Processor of query)
+ operators => available clause operators
+ conversion => Operator conversion. = > < !=
+ project() => projections
+ timeout() => delai max
+ hint() => index special ds la requete
+ find($id, $columns) => id avec les colonnes de sorties
+ get($columns) => retourne tous sauf columns de conditions
+ getFresh() alias de get() => colonnes de sorties
+ generateCacheKey()
+ aggregate()
+ exists() => si n'mport quelle resulat existe ds la requete
+ distinct() => Force the query to only return distinct results.
+ orderBy() => ajoute un tri ds la requete avec directon
+ whereBetween() => un where vec Between ...AND..
+ forPage($page) => limit et offset pour une page avec skip et take
+ insert(array) => insert + batch insert
+ insertGetId() => insert et retour l'id insérer
+ update($values) => modifie
+ increment($column) => incrémente une colonne
+ decrement($column) => décréùente une colonne
+ delete($id)
+ from()
+ truncate()
+ lists() => Get an array with the values of a given column.
+ raw() => evaluate an expression
+ push() => Append one or more values to an array
+ pull() => Remove one or more values from an array
+ drop() => Remove one or more fields.
+ newQuery() => new instance of the query builder.(subquery)
+ convertKey() => ???
+ where()
+ compileWheres() => convertis les mots clefs + id +AND|OR + Recursisve where
+ compileWhereBasic() => Like +Regexp +not +
+ compileWhereNested() + compileWhereIn() + compileWhereNotIn()() + compileWhereNull() + compileWhereNotNull() + compileWhereBetween() + compileWhereRaw()


+ NB: Collection must have Collection Eloquant method or BaseCollection (abstract)


Second Part: Eloquant ORM
-------------------------

Builder

Collection



SchemaBuilder (with connection)
+ hasTable() / hasCollection() / hasColumns()
+ create() / drop()