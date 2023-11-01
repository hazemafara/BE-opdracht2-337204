<?php

class Instructeur extends BaseController
{
    private $instructeurModel;

    public function __construct()
    {
        $this->instructeurModel = $this->model('InstructeurModel');
    }

    public function overzichtInstructeur()
    {
        $result = $this->instructeurModel->getInstructeurs();
        $rows = "";

        foreach ($result as $instructeur) {


            $rows .= "<tr>
                        <td>$instructeur->Voornaam</td>
                        <td>$instructeur->Tussenvoegsel</td>
                        <td>$instructeur->Achternaam</td>
                        <td>$instructeur->Mobiel</td>
                        <td>$instructeur->DatumInDienst</td>            
                        <td>$instructeur->AantalSterren</td>            
                        <td>
                            <a href='" . URLROOT . "/instructeur/overzichtvoertuigen/$instructeur->Id'>
                                <img src='https://www.freeiconspng.com/thumbs/car-icon-png/car-icon-png-25.png' width = 40px></i>
                            </a>
                        </td>            
                      </tr>";
        }

        $data = [
            'title' => 'Instructeurs in dienst',
            'rows' => $rows
        ];

        $this->view('Instructeur/overzichtinstructeur', $data);
    }

    public function overzichtVoertuigen($Id)
    {
         

        $instructeurInfo = $this->instructeurModel->getInstructeurById($Id);

        // var_dump($instructeurInfo);
        $naam = $instructeurInfo->Voornaam . " " . $instructeurInfo->Tussenvoegsel . " " . $instructeurInfo->Achternaam;
        $datumInDienst = $instructeurInfo->DatumInDienst;
        $aantalSterren = $instructeurInfo->AantalSterren;

  
        $result = $this->instructeurModel->getToegewezenVoertuigen($Id);


        $tableRows = "";
  
      
            foreach ($result as $voertuig) {

           

                $tableRows .= "<tr>
                                    <td>$voertuig->TypeVoertuig</td>
                                    <td>$voertuig->Type</td>
                                    <td>$voertuig->Kenteken</td>
                                    <td>$voertuig->Bouwjaar</td>
                                    <td>$voertuig->Brandstof</td>
                                    <td>$voertuig->RijbewijsCategorie</td>
                                    <td><a href='/instructeur/wijzig/$voertuig->Id'>Wijzigen</a></td>
                                    <td><a href='/instructeur/unassign/$Id/$voertuig->Id'>Verwijderen</a></td>
                            </tr>";
            }
        


        $data = [
            'title'     => 'Door instructeur gebruikte voertuigen',
            'tableRows' => $tableRows,
            'naam'      => $naam,
            'datumInDienst' => $datumInDienst,
            'aantalSterren' => $aantalSterren,
            'id' => $Id,

        ];

        $this->view('Instructeur/overzichtVoertuigen', $data);
    }

    function wijzig($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $currentInstructeur = $this->instructeurModel->getVoertuigInstructeur($id);

            $instructeur = $_POST["instructeur"];
            $typeVoertuig = $_POST["type_voertuig"];
            $type = $_POST["type"];
            $bouwjaar = $_POST["bouwjaar"];
            $brandstof = $_POST["brandstof"];
            $kenteken = $_POST["kenteken"];

            $this->instructeurModel->updateVoertuig($id, $instructeur, $typeVoertuig, $type, $bouwjaar, $brandstof, $kenteken);

            if ($currentInstructeur) {
                header("Location: /instructeur/overzichtvoertuigen/$currentInstructeur");
            } else {
                $this->instructeurModel->assignVoertuigToInstructeur($id, $instructeur);
                header("Location: /instructeur/overzichtvoertuigen/$instructeur");
            }
        } else {
            $instructeurs = $this->instructeurModel->getInstructeurs();
            $typeVoertuig = $this->instructeurModel->getTypeVoertuigen();
            $voertuig = $this->instructeurModel->getVoertuigById($id);

            $data = [
                'title'     => 'Wijzigen voertuiggegevens',
                'instructeurs' => $instructeurs,
                'typeVoertuig' => $typeVoertuig,
                'voertuig' => $voertuig,
            ];

            $this->view("Instructeur/wijzigen", $data);
        }
    }

    public function overzichtBeschikbareVoertuigen($Id)
    {
         

        $instructeurInfo = $this->instructeurModel->getInstructeurById($Id);

        $naam = $instructeurInfo->Voornaam . " " . $instructeurInfo->Tussenvoegsel . " " . $instructeurInfo->Achternaam;
        $datumInDienst = $instructeurInfo->DatumInDienst;
        $aantalSterren = $instructeurInfo->AantalSterren;

   
        $result = $this->instructeurModel->getBeschikbareVoertuigen($Id);


        $tableRows = "";

       
            foreach ($result as $voertuig) {


                $tableRows .= "<tr>
                                    <td>$voertuig->TypeVoertuig</td>
                                    <td>$voertuig->Type</td>
                                    <td>$voertuig->Kenteken</td>
                                    <td>$voertuig->Bouwjaar</td>
                                    <td>$voertuig->Brandstof</td>
                                    <td>$voertuig->RijbewijsCategorie</td>
                                    <td><a href='/instructeur/toevoegen/$voertuig->Id/$instructeurInfo->Id'>Add</a></td>
                                    <td><a href='/instructeur/wijzig/$voertuig->Id'>Update</a></td>
                                    <td><a href='/instructeur/verwijder/$Id/$voertuig->Id'>Delete</a></td>
                            </tr>";
            }
        


        $data = [
            'title'     => 'Alle beschikbare voertuigen',
            'tableRows' => $tableRows,
            'naam'      => $naam,
            'datumInDienst' => $datumInDienst,
            'aantalSterren' => $aantalSterren,
           
        ];

        $this->view('Instructeur/overzichtBeschikbareVoertuigen', $data);
    }

    public function toevoegen($voertuigId, $instructeurId)
    {
        $this->instructeurModel->assignVoertuigToInstructeur($voertuigId, $instructeurId);
        header("Location: /instructeur/overzichtvoertuigen/$instructeurId");
    }

    function unassign($instructeurId, $voertuigId)
    {
        $this->instructeurModel->unassignVoertuig($voertuigId);

       

    //     header("Location: /instructeur/overzichtvoertuigen/$instructeurId");
    // }

    // function verwijder($instructeurId, $voertuigId)
    // {
    //     // $this->instructeurModel->verwijderVoertuig($voertuigId);

      

    //     // header("Location: /instructeur/overzichtBeschikbareVoertuigen/$instructeurId");
    }

    // public function overzichtAlleVoertuigen()
    {
         

        // $result = $this->instructeurModel->getAlleVoertuigen();


        // $tableRows = "";

   
            // foreach ($result as $voertuig) {

             
                $tableRows .= "<tr>
                                    <td>$voertuig->TypeVoertuig</td>
                                    <td>$voertuig->Type</td>
                                    <td>$voertuig->Kenteken</td>
                                    <td>$voertuig->Bouwjaar</td>
                                    <td>$voertuig->Brandstof</td>
                                    <td>$voertuig->RijbewijsCategorie</td>
                                    <td>$voertuig->InstructeurNaam</td>
                                    <td><a href='/instructeur/wijzig/$voertuig->Id'>Wijzigen</a></td>
                                    <td><a href='/instructeur/unassignEnVerwijder/$voertuig->Id'>Verwijderen</a></td>
                            </tr>";
            }
    


        $data = [
            'title'     => 'Alle beschikbare voertuigen',
            'tableRows' => $tableRows,
        ];

        $this->view('Instructeur/overzichtAlleVoertuigen', $data);
    }

    function unassignEnVerwijder($voertuigId)
    {
        $this->instructeurModel->unassignVoertuig($voertuigId);
        $this->instructeurModel->verwijderVoertuig($voertuigId);


        header("Location: /instructeur/overzichtAlleVoertuigen");
    }
}
