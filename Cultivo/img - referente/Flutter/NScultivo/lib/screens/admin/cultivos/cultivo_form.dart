import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../../models/cultivo_model.dart';
import '../../../providers/cultivo_provider.dart';
import '../../../config/theme.dart';

class CultivoForm extends StatefulWidget {
  final Cultivo? cultivo;

  const CultivoForm({Key? key, this.cultivo}) : super(key: key);

  @override
  State<CultivoForm> createState() => _CultivoFormState();
}

class _CultivoFormState extends State<CultivoForm> {
  final _formKey = GlobalKey<FormState>();
  final _nombreController = TextEditingController();
  final _tipoController = TextEditingController();
  DateTime _fecha = DateTime.now();

  @override
  void initState() {
    super.initState();
    if (widget.cultivo != null) {
      _nombreController.text = widget.cultivo!.nombre;
      _tipoController.text = widget.cultivo!.tipo;
      _fecha = widget.cultivo!.fecha;
    }
  }

  @override
  void dispose() {
    _nombreController.dispose();
    _tipoController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Dialog(
      child: Container(
        padding: const EdgeInsets.all(16),
        constraints: const BoxConstraints(maxWidth: 400),
        child: Form(
          key: _formKey,
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Text(
                widget.cultivo == null ? 'Nuevo Cultivo' : 'Editar Cultivo',
                style: const TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: AppTheme.primaryColor,
                ),
              ),
              const SizedBox(height: 24),
              TextFormField(
                controller: _nombreController,
                decoration: const InputDecoration(
                  labelText: 'Nombre del Cultivo',
                  prefixIcon: Icon(Icons.agriculture),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Por favor ingresa un nombre';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _tipoController,
                decoration: const InputDecoration(
                  labelText: 'Tipo de Cultivo',
                  prefixIcon: Icon(Icons.category),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Por favor ingresa un tipo';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),
              InkWell(
                onTap: () async {
                  final fecha = await showDatePicker(
                    context: context,
                    initialDate: _fecha,
                    firstDate: DateTime(2000),
                    lastDate: DateTime(2100),
                  );
                  if (fecha != null) {
                    setState(() {
                      _fecha = fecha;
                    });
                  }
                },
                child: InputDecorator(
                  decoration: const InputDecoration(
                    labelText: 'Fecha',
                    prefixIcon: Icon(Icons.calendar_today),
                  ),
                  child: Text(
                    '${_fecha.day}/${_fecha.month}/${_fecha.year}',
                  ),
                ),
              ),
              const SizedBox(height: 24),
              Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  TextButton(
                    onPressed: () => Navigator.pop(context),
                    child: const Text('Cancelar'),
                  ),
                  const SizedBox(width: 16),
                  Consumer<CultivoProvider>(
                    builder: (context, provider, _) {
                      return ElevatedButton(
                        onPressed: provider.isLoading
                            ? null
                            : () async {
                                if (_formKey.currentState!.validate()) {
                                  final cultivo = Cultivo(
                                    id: widget.cultivo?.id,
                                    userId: 0, // Este valor vendrá del usuario autenticado
                                    nombre: _nombreController.text,
                                    tipo: _tipoController.text,
                                    fecha: _fecha,
                                  );

                                  bool success;
                                  if (widget.cultivo == null) {
                                    success = await provider.createCultivo(cultivo);
                                  } else {
                                    success = await provider.updateCultivo(
                                        widget.cultivo!.id!, cultivo);
                                  }

                                  if (success && mounted) {
                                    Navigator.pop(context, true);
                                  }
                                }
                              },
                        child: provider.isLoading
                            ? const SizedBox(
                                height: 20,
                                width: 20,
                                child: CircularProgressIndicator(
                                  strokeWidth: 2,
                                  valueColor:
                                      AlwaysStoppedAnimation<Color>(Colors.white),
                                ),
                              )
                            : Text(
                                widget.cultivo == null ? 'Crear' : 'Actualizar',
                              ),
                      );
                    },
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
} 