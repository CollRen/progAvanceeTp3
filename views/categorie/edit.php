{{ include('layouts/header.php', { title: 'Categorie'})}}
    <div class="container">
        <h2>Categorie Edit</h2>
        <form method="post">
        <label>Nom
                <input type="text" name="nom" value="{{ categorie.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}