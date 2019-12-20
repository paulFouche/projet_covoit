package com.eseo.dao;

import java.util.Date;

public class Covoiturage {

    private Integer id;
    private String localisationDepart;
    private Date dateDepart;
    private String localisationArrivee;
    private Double prix;
    private Integer nbPlaces;
    private Integer idCreateur;
    private Integer idEvenement;

    // GETTERS
    private Integer getId(){
        return this.id;
    }

    private String getLocalisationDepart(){
        return this.localisationDepart;
    }

    private Date getDateDepart(){
        return this.dateDepart;
    }

    private String getLocalisationArrivee(){
        return this.localisationArrivee;
    }

    private Double getPrix(){
        return this.prix;
    }

    private Integer nbPlaces(){
        return this.nbPlaces;
    }

    private Integer getIdCreateur(){
        return this.idCreateur;
    }

    private Integer getIdEvenement(){
        return this.idEvenement;
    }

    //SETTERS
    private void setId(Integer id){
        this.id = id;
    }

    public void setLocalisationDepart(String localisationDepart) {
        this.localisationDepart = localisationDepart;
    }

    public void setDateDepart(Date dateDepart) {
        this.dateDepart = dateDepart;
    }

    public void setLocalisationArrivee(String localisationArrivee) {
        this.localisationArrivee = localisationArrivee;
    }

    public void setPrix(Double prix) {
        this.prix = prix;
    }

    public void setNbPlaces(Integer nbPlaces) {
        this.nbPlaces = nbPlaces;
    }

    public void setIdCreateur(Integer idCreateur) {
        this.idCreateur = idCreateur;
    }

    public void setIdEvenement(Integer idEvenement) {
        this.idEvenement = idEvenement;
    }
}
