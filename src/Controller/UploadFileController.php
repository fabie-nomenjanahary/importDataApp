<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Entity\Proprietaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Form\UploadFileType;
use App\Entity\Vehicule;
use App\Entity\Vendeur;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UploadFileController extends AbstractController
{
    #[Route('/', name: 'app_upload_file')]
    public function index(ValidatorInterface $validator,ManagerRegistry $doctrine,Request $request,VehiculeRepository $vehiculeRepository)
    {
        //Form for uploading the file
        $entityManager=$doctrine->getManager();

        $form = $this->createForm(UploadFileType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $uploadedFile = $form->get('data_file')->getData();

            // Load the uploaded file
            $spreadsheet = IOFactory::load($uploadedFile->getPathname());

            // Remove the heading line of the excel file
            $rows = $spreadsheet->getActiveSheet()->removeRow(1);
            //Convert the data into an array
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            foreach ($sheetData as &$row){
                // Define an array of required column names
                $colonnesRequis = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI'];

                // Iterate over required columns
                foreach ($colonnesRequis as $colonne){
                    // If the required column doesn't exist in the current row, create it with null value
                    if (!isset($row[$colonne])){
                        $row[$colonne] = null;
                    }
                }
                /****Extract data from the row from the Excel file*****/
                $compteAffaire = $row['A'];
                $compteEvent = $row['B'];
                $dernierEvent = $row['C'];
                $numeroFiche = $row['D'];
                $civilite = $row['E'];
                $surnom = $row['F'];
                $nom = $row['G'];
                $prenom = $row['H'];
                $voie = $row['I'];
                $complementAdr = $row['J'];
                $codePostal = $row['K'];
                $ville = $row['L'];
                $telDomicile = $row['M'];
                $telPortable = $row['N'];
                $telJob = $row['O'];
                $email = $row['P'];
                $dateCircul = $this->convertStringToDate('d/m/Y', $row['Q']);
                $dateAchat = $this->convertStringToDate('d/m/Y', $row['R']);
                $dateDernierEvent = $this->convertStringToDate('d/m/Y', $row['S']);
                $marque = $row['T'];
                $modele = $row['U'];
                $version = $row['V'];
                $VIN = $row['W'];
                $matricule = $row['X'];
                $prospect = $row['Y'];
                $kilometrage = $row['Z'];
                $energie = $row['AA'];
                $vendeurVN = $row['AB'];
                $vendeurVO = $row['AC'];
                $commentaire = $row['AD'];
                $typeVehicule = $row['AE'];
                $numeroDossier = $row['AF'];
                $intermediaire = $row['AG'];
                $dateEvent = $this->convertStringToDate('d/m/Y', $row['AH']);
                $origineEvent = $row['AI']; 
                /*----------------------------------------------*/
                //check if the 'vendeur' already exists or not : save if it doesnt exist
                $vendeur_existant = $entityManager->getRepository(Vendeur::class)->findOneBy(array('vendeurVN' => $vendeurVN,'vendeurVO' => $vendeurVO,'intermediaire' => $intermediaire));
                $vendeur=$vendeur_existant;
                if (!$vendeur_existant)
                {
                    if ($vendeurVN!=null || $vendeurVO!=null || $intermediaire!=null) {
                        $vendeur = new Vendeur();
                        $vendeur->setVendeurVN($vendeurVN);
                        $vendeur->setVendeurVO($vendeurVO);
                        $vendeur->setIntermediaire($intermediaire);
                        $entityManager->persist($vendeur);
                        
                    }
                }

                //check if the 'adresse' already exists or not : save if it doesnt exist
                $adresse_existant = $entityManager->getRepository(Adresse::class)->findOneBy(array('codePostal' => $codePostal));
                $adresse=$adresse_existant;
                if (!$adresse_existant)
                {
                    if ($codePostal!=null || $ville!=null || $voie!=null || $complementAdr!=null) {
                        $adresse = new Adresse();
                        $adresse->setCodePostal($codePostal);
                        $adresse->setVille($ville);
                        $adresse->setVoie($voie);
                        $adresse->setComplementAdr($complementAdr);
                        $entityManager->persist($adresse);
                        
                    }
                }

                //check if the 'contact' already exists or not : save if it doesnt exist
                $contact_existant = $entityManager->getRepository(Contact::class)->findOneBy(array('email' => $email,'telDomicile' => $telDomicile,'telPortable' => $telPortable));
                $contact=$contact_existant;
                if (!$contact_existant)
                {
                    if ($email!=null || $telDomicile!=null || $telPortable!=null || $telJob!=null) {
                        $contact = new Contact();
                        $contact->setEmail($email);
                        $contact->setTelDomicile($telDomicile);
                        $contact->setTelPortable($telPortable);
                        $contact->setTelJob($telJob);
                        $entityManager->persist($contact);
                        
                    }
                }

                //check if the 'proprietaire' already exists or not : save if it doesnt exist
                $proprietaire_existant = $entityManager->getRepository(Proprietaire::class)->findOneBy(array('surnom' => $surnom,'nom'=>$nom));
                $proprietaire=$proprietaire_existant;
                if (!$proprietaire_existant)
                {
                    if ($surnom!=null || $nom!=null || $prenom!=null || $civilite!=null) {
                        $proprietaire = new Proprietaire();
                        $proprietaire->setSurnom($surnom);
                        $proprietaire->setNom($nom);
                        $proprietaire->setPrenom($prenom);
                        $proprietaire->setAdresse($adresse);
                        $proprietaire->setContact($contact);
                        $proprietaire->setCivilite($civilite);
                        $entityManager->persist($proprietaire);
                        
                    }
                }

                //check if the 'compte' already exists or not : save if it doesnt exist
                $compte_existant = $entityManager->getRepository(Compte::class)->findOneBy(array('compteAffaire' => $compteAffaire,'compteEvent'=>$compteEvent,'dernierEvent'=>$dernierEvent));
                $compte=$compte_existant;
                if (!$compte_existant)
                {
                    if ($compteAffaire!=null || $compteEvent!=null || $dernierEvent!=null) {
                        $compte = new Compte();
                        $compte->setCompteAffaire($compteAffaire);
                        $compte->setCompteEvent($compteEvent);
                        $compte->setDernierEvent($dernierEvent);
                        $entityManager->persist($compte);
                        
                    }
                }

                //check if the 'evenement' already exists or not : save if it doesnt exist
                $evenement_existant = $entityManager->getRepository(Evenement::class)->findOneBy(array('origineEvent' => $origineEvent,'dateEvent' => $dateEvent,'dateDernierEvent' => $dateDernierEvent,'commentaire' => $commentaire));
                $evenement=$evenement_existant;
                if (!$evenement_existant)
                {
                    if ($origineEvent!=null || $commentaire!=null || $dateEvent!=null || $dateDernierEvent!=null) {
                        $evenement = new Evenement();
                        $evenement->setOrigineEvent($origineEvent);
                        $evenement->setCommentaire($commentaire);
                        $evenement->setDateEvent($dateEvent);
                        $evenement->setDateDernierEvent($dateDernierEvent);
                        $entityManager->persist($evenement);
                        
                    }
                }

                //check if the 'vehicule' already exists or not : save if it doesnt exist
                $vehicule_existant = $entityManager->getRepository(Vehicule::class)->findOneBy(array('VIN' => $VIN,'matricule'=>$matricule));
                $vehicule=$vehicule_existant;
                if (!$vehicule_existant)
                {
                    if ($numeroFiche!=null || $VIN!=null || $matricule!=null) {
                        $vehicule = new Vehicule();
                        $vehicule->setNumeroFiche($numeroFiche);
                        $vehicule->setDateCircul($dateCircul);
                        $vehicule->setDateAchat($dateAchat);
                        $vehicule->setMarque($marque);
                        $vehicule->setModele($modele);
                        $vehicule->setVersion($version);
                        $vehicule->setVIN($VIN);
                        $vehicule->setMatricule($matricule);
                        $vehicule->setProspect($prospect);
                        $vehicule->setKilometrage($kilometrage);
                        $vehicule->setEnergie($energie);
                        $vehicule->setTypeVehicule($typeVehicule);
                        $vehicule->setNumeroDossier($numeroDossier);
                        $vehicule->setProprietaire($proprietaire);
                        $vehicule->setCompte($compte);
                        $vehicule->setVendeur($vendeur);
                        $vehicule->setEvenement($evenement);
                        $entityManager->persist($vehicule);
                    }
                }
                $entityManager->flush();
            }
            $this->addFlash('success','Données importées et enregistrées avec succès');

        }
        //get error messages from the form and send it to view
        $errors = $validator->validate($form);
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }

        //get all the saved 'vehicules' with their related data : compte,evenement,proprietaire,vendeur...
        $vehicules = $entityManager->getRepository(Vehicule::class)->findAllVehiculesWithAllRelatedData();

        return $this->render('upload_file/upload.html.twig', [
            'form' => $form->createView(),
            'data'=>$vehicules,
            'errors'=>$errorMessages
        ]);
    }
    public function convertStringToDate($format,$dateString){
        $dateConverted=null;
        if ($dateString!=null) {
            $dateConverted= \DateTime::createFromFormat($format, $dateString);
            if (!($dateConverted instanceof \DateTime)) {
                //if not a datetime object
                $dateConverted=null;
            }
        }
        return $dateConverted;
    }
}

