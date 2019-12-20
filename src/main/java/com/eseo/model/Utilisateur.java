package com.eseo.model;

public class Utilisateur {

    private String email;
    private String motDePasse;
    private String nom;
    private String prenom;
    private String tel;
    private int id;

    public Utilisateur(String email, String motDePasse, String nom, String prenom, String tel, int id) {
        this.email = email;
        this.motDePasse = motDePasse;
        this.nom = nom;
        this.prenom = prenom;
        this.tel = tel;
        this.id = id;
    }

    public void setEmail(String email) {
        this.email = email;
    }
    public String getEmail() {
        return email;
    }

    public void setMotDePasse(String motDePasse) {
        this.motDePasse = motDePasse;
    }
    public String getMotDePasse() {
        return motDePasse;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }
    public String getNom() {
        return nom;
    }

    public String getPrenom(){
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public int getId(){
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
}
