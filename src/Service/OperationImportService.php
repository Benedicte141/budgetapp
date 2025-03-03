<?php
namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Interface\OperationImportInterface;
use App\Entity\Operation;
use App\Entity\Compte;
use App\Entity\Banque;
use App\Entity\BankApi;
use App\Repository\BankApiRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;



class OperationImportService implements OperationImportInterface{
    private BankApiRepository $bARep;
    private BankApi $bAIns;
    private array $bAFM;
    private array $importErrors;
    private array $json;
    private Compte $compte;
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->importErrors = [];
    }

    public function setData($json, $compteAssocie){
        echo $json;
        $this->compte = $compteAssocie;
        echo $this->compte->getNom();
        
        $decodedJson = json_decode($json, true); // Décodage en tableau associatif


        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Le JSON fourni est invalide : ' . json_last_error_msg());
        }

        $this->json = $decodedJson;
        $this->bARep = $this->doctrine->getRepository(BankApi::class);


        $this->importOperations($this->compte->getBanque());
    }
    
    
    
    
    /**
    * Importe les opérations d'un compte bancaire depuis une API bancaire
    * @param Banque $banque l'API bancaire
    * @param array $options options pour configurer l'importation (e.g., période)
    */
    public function importOperations(Banque $banque, array $options = []): void{
        $api = $banque->getBankApi();
        if($api){

            $this->bAIns = $api;
            $this->bAFM = $this->bAIns->getFieldMapping();
        }
        else{
            $this->importError[]="La banque ".$banque->getNom()."n'a pas d'API";
        }
    }



    /**
    * Parse une opération bancaire depuis l'API bancaire en utilisant le mapping de champs défini dans fieldMapping
    * @param array $operationArray tableau associatif de l'opération bancaire
    * @return ?Operation retourne une opération ou null si le parsing échoue
    */
    public function parseOperation(array $operationArray): ?Operation{
        
        
    }
    /**
    * Vérifie la validité des champs d'une opération
    * @param Operation $operation
    * @return bool
    */


    public function validateOperation(Operation $operation): bool{
        
    }
    /**
    * Retourne uniquement les opérations valides qui n'existent pas déjà dans la base de données (avec externalId)
    * @param Operation[] $normalizedOperations tableau associatif des opérations bancaires
    * @return Operation[] tableau des opérations non dupliquées
    */
    public function checkDuplicates(array $normalizedOperations): array{
        // $operation
    }
    /**
    * Retourne la liste des erreurs d'importation avec leur contexte
    * @return array<array{error: ImportationError, operation: ?Operation}>
    */



    public function getImportationErrors(): array{
        
    }
    /**
    * Retourne les opérations importées lors de la dernière importation
    * @return Operation[]
    */


    
    public function getOperations(): array{
        
    }
}
