<?php

namespace App\Http\Controllers;
use App\Http\Repositories\AvaliationRepository; // Repositório de Avaliações
use App\Http\Requests\StoreAvaliationRequest;
use App\Http\Requests\AvaliationFirstStep;
use App\Http\Services\File\CreateFileService; // Serviço para criar arquivos
use App\Models\Avaliation;
use Illuminate\Http\Response;

class AvaliationController extends Controller
{
    protected $avaliationRepository;
    protected $createFileService;

    public function __construct(AvaliationRepository $avaliationRepository, CreateFileService $createFileService)
    {
        $this->avaliationRepository = $avaliationRepository;
        $this->createFileService = $createFileService;
    }

    public function step1(AvaliationFirstStep $request)
    {
          // Validação dos dados recebidos na requisição

         $validatedData = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'age' => ['required', 'integer', 'min:0'],
            'date' => ['required', 'date_format:Y-m-d H:i:s'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'observations_to_student' => ['nullable', 'string'],
            'observations_to_nutritionist' => ['nullable', 'string'],
        ], );

        // Crie uma instância de Avaliation e preenche com os dados validados
        $avaliation = new Avaliation();

        $avaliation->student_id = $validatedData['student_id'];
        $avaliation->age = $validatedData['age'];
        $avaliation->date = $validatedData['date'];
        $avaliation->weight = $validatedData['weight'];
        $avaliation->height = $validatedData['height'];
        $avaliation->observations_to_student = $validatedData['observations_to_student'];
        $avaliation->observations_to_nutritionist = $validatedData['observations_to_nutritionist'];
        $avaliation->measures = [];

        // Salve a avaliação no banco de dados
        $avaliation->save();

        return response()->json(['Mensagem' => 'Dados da etapa 1 salvos com sucesso'], Response::HTTP_OK);
    }


    public function step2(StoreAvaliationRequest $request)
    {
        // Validação e processamento dos dados da segunda etapa
    }
    public function step3(StoreAvaliationRequest $request)
    {
        // Validação e processamento dos dados da terceira etapa
        try {
            $data = $request->validated();

            // Usando CreateFileService para manipular o upload do arquivo
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                // Substitua 'folderPath' pelo caminho desejado dentro do seu armazenamento
                $folderPath = 'avaliations';

                // Note: A função handle espera um nome, que você pode obter do arquivo ou gerar como preferir
                $name = time() . '_' . $file->getClientOriginalName();

                $createdFile = $this->createFileService->handle($folderPath, $file, $name);

                // Assumindo que o método handle retorna a instância do arquivo com um id
                $data['file_id'] = $createdFile->id;
            } else {
                throw new \Exception("Falha no upload do arquivo.");
            }

            // Criar avaliação com os dados validados e o ID do arquivo
            $createdAvaliation = $this->avaliationRepository->createAvaliation($data);

            return response()->json($createdAvaliation, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}



