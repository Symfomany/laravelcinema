<html>
    <body>
        <h1>Creation categories</h1>

        <form action="{{ route('categories_store') }}" method="post">

            <label for="title">Titre</label>
            <input placeholder="Votre contenu..." name="title" id="id">

            <textarea placeholder="Votre contenu..." name="desc">
            </textarea>

            <button type="submit">Enregistrer ce film</button>

            {{ csrf_field() }}

        </form>
    </body>
</html>