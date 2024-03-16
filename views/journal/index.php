{{ include('layouts/header.php', { title: 'Journal'})}}
<h1>Journal de connexion</h1>
<table>
    <thead>
        <tr>
            <th>Nom utilisateur</th>
            <th>Date</th>
            <th>Page visitée</th>
            <th>Adresse IP</th>
        </tr>
    </thead>
    <tbody>
        {% if journals is defined %}
        {% for journal in journals %}
        <tr>
            <td>{{ journal.username }}</td>
            <td>{{ journal.date}}</td>
            <td>{{ journal.page_visited }}</td>
            <td>{{ journal.ip_address }}</td>
            {% endfor %}
            {% endif %}
        </tr>
    </tbody>
</table>

{{ include('layouts/footer.php') }}