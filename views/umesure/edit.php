{{ include('layouts/header.php', { title: 'Umesure'})}}
    <div class="container">
        <h2>Umesure Edit</h2>
        <form method="post">
        <label>Nom
                <input type="text" name="nom" value="{{ umesure.nom }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.nom }}</span>
            {% endif %}
           
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
    {{ include('layouts/footer.php') }}