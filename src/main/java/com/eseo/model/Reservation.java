package com.eseo.model;

public class Reservation {

    private Integer id;
    private Integer idUtilisateur;
    private Integer idCovoiturage;

    public Reservation(Integer id, Integer idUtilisateur, Integer idCovoiturage) {
        this.id = id;
        this.idUtilisateur = idUtilisateur;
        this.idCovoiturage = idCovoiturage;
    }

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
