<?php

public class Concessionaria {
    private int id_concessionaria;
    private String nome;
    private String endereco;
    private String telefone;

    // Getters and Setters
    public int getId_concessionaria() { return id_concessionaria; }
    public void setId_concessionaria(int id_concessionaria) { this.id_concessionaria = id_concessionaria; }
    public String getNome() { return nome; }
    public void setNome(String nome) { this.nome = nome; }
    public String getEndereco() { return endereco; }
    public void setEndereco(String endereco) { this.endereco = endereco; }
    public String getTelefone() { return telefone; }
    public void setTelefone(String telefone) { this.telefone = telefone; }

    // CRUD Operations
    public static void create(Connection conn, Concessionaria concessionaria) throws SQLException {
        String sql = "INSERT INTO concessionaria (nome, endereco, telefone) VALUES (?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, concessionaria.getNome());
            stmt.setString(2, concessionaria.getEndereco());
            stmt.setString(3, concessionaria.getTelefone());
            stmt.executeUpdate();
        }
    }

    public static Concessionaria read(Connection conn, int id_concessionaria) throws SQLException {
        String sql = "SELECT * FROM concessionaria WHERE id_concessionaria = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_concessionaria);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Concessionaria concessionaria = new Concessionaria();
                    concessionaria.setId_concessionaria(rs.getInt("id_concessionaria"));
                    concessionaria.setNome(rs.getString("nome"));
                    concessionaria.setEndereco(rs.getString("endereco"));
                    concessionaria.setTelefone(rs.getString("telefone"));
                    return concessionaria;
                }
            }
        }
        return null;
    }

    public static void update(Connection conn, Concessionaria concessionaria) throws SQLException {
        String sql = "UPDATE concessionaria SET nome = ?, endereco = ?, telefone = ? WHERE id_concessionaria = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, concessionaria.getNome());
            stmt.setString(2, concessionaria.getEndereco());
            stmt.setString(3, concessionaria.getTelefone());
            stmt.setInt(4, concessionaria.getId_concessionaria());
            stmt.executeUpdate();
        }
    }

    public static void delete(Connection conn, int id_concessionaria) throws SQLException {
        String sql = "DELETE FROM concessionaria WHERE id_concessionaria = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_concessionaria);
            stmt.executeUpdate();
        }
    }

    public static List<Concessionaria> getAll(Connection conn) throws SQLException {
        String sql = "SELECT * FROM concessionaria";
        List<Concessionaria> list = new ArrayList<>();
        try (Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Concessionaria concessionaria = new Concessionaria();
                concessionaria.setId_concessionaria(rs.getInt("id_concessionaria"));
                concessionaria.setNome(rs.getString("nome"));
                concessionaria.setEndereco(rs.getString("endereco"));
                concessionaria.setTelefone(rs.getString("telefone"));
                list.add(concessionaria);
            }
        }
        return list;
    }
}
?>