{{ include('layouts/header.php', { title: 'Create'})}}

    <h1>{{ var }}</h1>

    <section>
            <a href="{{base}}/recette">Recette</a>
            <a href="{{base}}/auteur">Auteurs</a>
            <a href="{{base}}/ingredient">Ingrédients</a>
    </section>

    <div>
        <img src="../public/assets/images/imageMvc_auteurs-copie.jpg" alt="">
    </div>

    {{ include('layouts/footer.php') }}