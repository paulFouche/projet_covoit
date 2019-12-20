package com.eseo.model;

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

    public Covoiturage(Integer id, String localisationDepart, Date dateDepart, String localisationArrivee, Double prix, Integer nbPlaces, Integer idCreateur, Integer idEvenement) {
        this.id = id;
        this.localisationDepart = localisationDepart;
        this.dateDepart = dateDepart;
        this.localisationArrivee = localisationArrivee;
        this.prix = prix;
        this.nbPlaces = nbPlaces;
        this.idCreateur = idCreateur;
        this.idEvenement = idEvenement;
    }

    // GETTERS
    public Integer getId(){
        return this.id;
    }

    public String getLocalisationDepart(){
        return this.localisationDepart;
    }

    public Date getDateDepart(){
        return this.dateDepart;
    }

    public String getLocalisationArrivee(){
        return this.localisationArrivee;
    }

    public Double getPrix(){
        return this.prix;
    }

    public Integer nbPlaces(){
        return this.nbPlaces;
    }

    public Integer getIdCreateur(){
        return this.idCreateur;
    }

    public Integer getIdEvenement(){
        return this.idEvenement;
    }

    //SETTERS
    public void setId(Integer id){
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
