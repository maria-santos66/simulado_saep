<?php

public class Automovel {
    private int id_automovel;
    private int id_concessionaria;
    private String modelo;
    private String marca;
    private Date ano_fabricacao;
    private float preco;

    // Getters and Setters
    public int getId_automovel() { return id_automovel; }
    public void setId_automovel(int id_automovel) { this.id_automovel = id_automovel; }
    public int getId_concessionaria() { return id_concessionaria; }
    public void setId_concessionaria(int id_concessionaria) { this.id_concessionaria = id_concessionaria; }
    public String getModelo() { return modelo; }
    public void setModelo(String modelo) { this.modelo = modelo; }
    public String getMarca() { return marca; }
    public void setMarca(String marca) { this.marca = marca; }
    public Date getAno_fabricacao() { return ano_fabricacao; }
    public void setAno_fabricacao(Date ano_fabricacao) { this.ano_fabricacao = ano_fabricacao; }
    public float getPreco() { return preco; }
    public void setPreco(float preco) { this.preco = preco; }

    // CRUD Operations
    public static void create(Connection conn, Automovel automovel) throws SQLException {
        String sql = "INSERT INTO automovel (id_concessionaria, modelo, marca, ano_fabricacao, preco) VALUES (?, ?, ?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, automovel.getId_concessionaria());
            stmt.setString(2, automovel.getModelo());
            stmt.setString(3, automovel.getMarca());
            stmt.setDate(4, new java.sql.Date(automovel.getAno_fabricacao().getTime()));
            stmt.setFloat(5, automovel.getPreco());
            stmt.executeUpdate();
        }
    }

    public static Automovel read(Connection conn, int id_automovel) throws SQLException {
        String sql = "SELECT * FROM automovel WHERE id_automovel = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_automovel);
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    Automovel automovel = new Automovel();
                    automovel.setId_automovel(rs.getInt("id_automovel"));
                    automovel.setId_concessionaria(rs.getInt("id_concessionaria"));
                    automovel.setModelo(rs.getString("modelo"));
                    automovel.setMarca(rs.getString("marca"));
                    automovel.setAno_fabricacao(rs.getDate("ano_fabricacao"));
                    automovel.setPreco(rs.getFloat("preco"));
                    return automovel;
                }
            }
        }
        return null;
    }

    public static void update(Connection conn, Automovel automovel) throws SQLException {
        String sql = "UPDATE automovel SET id_concessionaria = ?, modelo = ?, marca = ?, ano_fabricacao = ?, preco = ? WHERE id_automovel = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, automovel.getId_concessionaria());
            stmt.setString(2, automovel.getModelo());
            stmt.setString(3, automovel.getMarca());
            stmt.setDate(4, new java.sql.Date(automovel.getAno_fabricacao().getTime()));
            stmt.setFloat(5, automovel.getPreco());
            stmt.setInt(6, automovel.getId_automovel());
            stmt.executeUpdate();
        }
    }

    public static void delete(Connection conn, int id_automovel) throws SQLException {
        String sql = "DELETE FROM automovel WHERE id_automovel = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id_automovel);
            stmt.executeUpdate();
        }
    }

    public static List<Automovel> getAll(Connection conn) throws SQLException {
        String sql = "SELECT * FROM automovel";
        List<Automovel> list = new ArrayList<>();
        try (Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(sql)) {
            while (rs.next()) {
                Automovel automovel = new Automovel();
                automovel.setId_automovel(rs.getInt("id_automovel"));
                automovel.setId_concessionaria(rs.getInt("id_concessionaria"));
                automovel.setModelo(rs.getString("modelo"));
                automovel.setMarca(rs.getString("marca"));
                automovel.setAno_fabricacao(rs.getDate("ano_fabricacao"));
                automovel.setPreco(rs.getFloat("preco"));
                list.add(automovel);
            }
        }
        return list;
    }
}
?>