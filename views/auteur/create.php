{{ include('layouts/header.php', { title: 'Aj Auteur'})}}
    <div class="container">
        <h2>Création d'un auteur</h2>
        <form method="post">

            <label>Prénom
                <input type="text" name="prenom" value="{{ auteur.prenom}}">
            </label>
            {% if errors.prenom is defined %}
                <span class="error">{{ errors.prenom}}</span>
            {% endif %}

            <label>Nom
                <input type="text" name="nom" value="{{ auteur.nom }}">
            </label>
            {% if errors.nom is defined %}
                <span class="error">{{ errors.nom}}</span>
            {% endif %}

            <input type="submit" class="btn" value="Save">
        </form>
    </div>
    {{ include('layouts/footer.php') }}