package com.eseo.dao;

public class Evenement {

    private int id;
    private String nom;
    private String description;
    private int nb_place;
    private String localisation;
    private String dateDebut;
    private String dateFin;

    public Evenement(int id, String nom, String description, int nb_place, String localisation, String dateDebut, String dateFin) {
        this.id = id;
        this.nom = nom;
        this.description = description;
        this.nb_place = nb_place;
        this.localisation = localisation;
        this.dateDebut = dateDebut;
        this.dateFin = dateFin;
    }

    //Getters
    public String getNom(){
        return nom;
    }

    public String getDescription(){
        return description;
    }

    public int getNb_place() {
        return nb_place;
    }

    public String getLocalisation() {
        return localisation;
    }

    public String getDateDebut() {
        return dateDebut;
    }

    public String getDateFin() {
        return dateFin;
    }

    public int getId() {
        return id;
    }

    //Setters

    public void setDescription(String description) {
        this.description = description;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setNb_place(int nb_place) {
        this.nb_place = nb_place;
    }

    public void setLocalisation(String localisation) {
        this.localisation = localisation;
    }

    public void setDateDebut(String dateDebut) {
        this.dateDebut = dateDebut;
    }

    public void setDateFin(String dateFin) {
        this.dateFin = dateFin;
    }
}
