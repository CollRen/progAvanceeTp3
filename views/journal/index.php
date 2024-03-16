{{ include('layouts/header.php', { title: 'Recette'})}}
<h1>Recette</h1>
<table>
    <thead>
        <tr>
            <th>Nom utilisateur</th>
            <th>Date</th>
            <th>Page visité</th>
            <th>Adresse IP</th>
        </tr>
    </thead>
    <tbody>
        {% if datas is defined %}
        {% for data in datas %}
        <tr>
            <td>{{ data.nom }}</td>
            <td>{{ data.data }}</td>
            <td>{{ data.page_visitee }}</td>
            <td>{{ data.adresse_ip }}</td>
            {% endfor %}
            {% endif %}
        </tr>
    </tbody>
</table>

{{ include('layouts/footer.php') }}