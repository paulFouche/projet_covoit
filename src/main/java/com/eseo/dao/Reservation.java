package com.eseo.dao;

public class Reservation {

    private Integer id;
    private Integer idUtilisateur;
    private Integer idCovoiturage;

    // GETTERS
    public Integer getId() {
        return id;
    }

    public Integer getIdUtilisateur() {
        return idUtilisateur;
    }

    public Integer getIdCovoiturage() {
        return idCovoiturage;
    }

    // SETTERS
    public void setId(Integer id) {
        this.id = id;
    }

    public void setIdUtilisateur(Integer idUtilisateur) {
        this.idUtilisateur = idUtilisateur;
    }

    public void setIdCovoiturage(Integer idCovoiturage) {
        this.idCovoiturage = idCovoiturage;
    }
}
