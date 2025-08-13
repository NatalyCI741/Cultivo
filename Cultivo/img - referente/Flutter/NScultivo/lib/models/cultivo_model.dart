class Cultivo {
  final int? id;
  final int userId;
  final String nombre;
  final String tipo;
  final DateTime fecha;
  final DateTime? createdAt;
  final DateTime? updatedAt;

  Cultivo({
    this.id,
    required this.userId,
    required this.nombre,
    required this.tipo,
    required this.fecha,
    this.createdAt,
    this.updatedAt,
  });

  factory Cultivo.fromJson(Map<String, dynamic> json) {
    return Cultivo(
      id: json['id'],
      userId: json['user_id'] ?? 0,
      nombre: json['nombre'] ?? '',
      tipo: json['tipo'] ?? '',
      fecha: DateTime.parse(json['fecha']),
      createdAt: json['created_at'] != null ? DateTime.parse(json['created_at']) : null,
      updatedAt: json['updated_at'] != null ? DateTime.parse(json['updated_at']) : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user_id': userId,
      'nombre': nombre,
      'tipo': tipo,
      'fecha': fecha.toIso8601String().split('T')[0],
    };
  }
} 